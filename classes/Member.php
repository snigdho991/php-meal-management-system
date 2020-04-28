<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php
	/**
	 * Member
	*/
	class Member {
		private $db;
		private $fm;

		public function __construct() {
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function memberInsert($data,$file){
			$username    = $this->fm->validation($data['username']);
			$email       = $this->fm->validation($data['email']);
			$password    = $this->fm->validation($data['password']);
			$contact     = $this->fm->validation($data['contact']);
			$institution = $this->fm->validation($data['institution']);
			$department  = $this->fm->validation($data['department']);
			$hometown    = $this->fm->validation($data['hometown']);
			$blood       = $this->fm->validation($data['blood']);
			$about       = $this->fm->validation($data['about']);

			$username    = mysqli_real_escape_string($this->db->link, $username);
			$email       = mysqli_real_escape_string($this->db->link, $email);
			$password    = mysqli_real_escape_string($this->db->link, $password);
			$contact     = mysqli_real_escape_string($this->db->link, $contact);
			$institution = mysqli_real_escape_string($this->db->link, $institution);
			$department  = mysqli_real_escape_string($this->db->link, $department);
			$hometown    = mysqli_real_escape_string($this->db->link, $hometown);
			$blood       = mysqli_real_escape_string($this->db->link, $blood);
			$about       = mysqli_real_escape_string($this->db->link, $about);
			

			$permited  = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name = $file['image']['name'];
		    $file_size = $file['image']['size'];
		    $file_temp = $file['image']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "uploads/".$unique_image;

		    if($username == "" || $email == "" || $password == "" || $institution == "" || $uploaded_image == ""){
		    	$msg = "<div class='alert alert-danger' role='alert'><strong> * </strong>marked field must not be empty.</div>";
				return $msg;
		    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            	$msg = "<div class='alert alert-danger' role='alert'><strong>Error ! </strong>Provided e-mail address is invalid.</div>";
            	return $msg;
        	} elseif ($file_size >1048567) {
			     $msg = "<div class='alert alert-danger' role='alert'><strong>Error ! </strong>Image Size should be less then 1 MB.</div>";
			     return $msg;
			} elseif (in_array($file_ext, $permited) === false) {
			     $msg = "<div class='alert alert-danger' role='alert'><strong>Error ! </strong>You can upload only:-"
			     .implode(', ', $permited)."</div>";
			     return $msg;
			} else {
				$password = mysqli_real_escape_string($this->db->link, md5($password));
				$mailquery = "SELECT * FROM tbl_member WHERE email = '$email' LIMIT 1";
        		$checkmail = $this->db->select($mailquery);
            	if ($checkmail != false){
                	$msg = "<div class='alert alert-danger' role='alert'><strong>Error ! </strong>Email already exists in the database.</div>";
                	return $msg;
            	} else {
				    move_uploaded_file($file_temp, $uploaded_image);
				    $query = "INSERT INTO tbl_member(username, email, password, contact, institution, department, hometown, blood, about, image) 
				    VALUES('$username','$email','$password','$contact','$institution','$department','$hometown','$blood','$about','$uploaded_image')";
				    $inserted_rows = $this->db->insert($query);
				    if ($inserted_rows) {
				     $msg = "<div class='alert alert-success' role='alert'><strong>Success ! </strong>Member successfully inserted into the database.</div>";
				     return $msg;
				    } else {
				     $msg = "<div class='alert alert-danger' role='alert'><strong>Error ! </strong>Product Isn't Inserted. Try again later.</div>";
				     return $msg;
				    }
				}
			}
		}

		public function getAllMember(){
			$query = "SELECT * FROM tbl_member ORDER BY memberId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function adminPanel(){
			$query = "SELECT * FROM tbl_admin ORDER BY adminId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function appointAdmin($data){
			$adminName    = $this->fm->validation($data['adminName']);
			$adminUser    = $this->fm->validation($data['adminUser']);
			$adminEmail   = $this->fm->validation($data['adminEmail']);
			$adminPass    = $this->fm->validation($data['adminPass']);
			$adminContact = $this->fm->validation($data['adminContact']);
			$role         = $this->fm->validation($data['role']);

			$adminName    = mysqli_real_escape_string($this->db->link, $adminName);
			$adminUser    = mysqli_real_escape_string($this->db->link, $adminUser);
			$adminEmail   = mysqli_real_escape_string($this->db->link, $adminEmail);
			$adminPass    = mysqli_real_escape_string($this->db->link, $adminPass);
			$adminContact = mysqli_real_escape_string($this->db->link, $adminContact);
			$role         = mysqli_real_escape_string($this->db->link, $role);


			if($adminName == "" || $adminUser == "" || $adminEmail == "" || $adminPass == "" || $role == ""){
		    	$msg = "<div class='alert alert-danger' role='alert'><strong> * </strong>marked field must not be empty.</div>";
				return $msg;
		    } elseif (!filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
            	$msg = "<div class='alert alert-danger' role='alert'><strong>Error ! </strong>Provided e-mail address is invalid.</div>";
            	return $msg;
        	} else {
				$adminPass = mysqli_real_escape_string($this->db->link, md5($adminPass));
				$userquery = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' LIMIT 1";
        		$checkuser = $this->db->select($userquery);
            	if ($checkuser != false){
                	$msg = "<div class='alert alert-danger' role='alert'><strong>Error ! </strong>Username already exists in the database. Try another one.</div>";
                	return $msg;
            	} else {
				    $query = "INSERT INTO tbl_admin(adminName, adminUser, adminEmail, adminPass, adminContact, role) 
				    VALUES('$adminName','$adminUser','$adminEmail','$adminPass','$adminContact','$role')";
				    $inserted_rows = $this->db->insert($query);
				    if ($inserted_rows) {
				     $msg = "<div class='alert alert-success' role='alert'><strong>Success ! </strong>Admin appointed successfully.</div>";
				     return $msg;
				    } else {
				     $msg = "<div class='alert alert-danger' role='alert'><strong>Error ! </strong>Admin isn't appointed. Try again later.</div>";
				     return $msg;
				    }
				}
			}
		}

		public function paymentInsert($data){
			$payment  = $this->fm->validation($data['payment']);	
			$memberId = $this->fm->validation($data['memberId']);	

			$payment  = mysqli_real_escape_string($this->db->link, $payment);
			$memberId = mysqli_real_escape_string($this->db->link, $memberId);

			if($payment == "" || $memberId == ""){
		    	$msg = "<div class='alert alert-danger' role='alert'><strong> Error ! </strong>Field field must not be empty.</div>";
				return $msg;
		    } else {
			    $query = "INSERT INTO tbl_payment(memberId, payment) 
			    VALUES('$memberId', '$payment')";
			    $inserted_rows = $this->db->insert($query);
			    if ($inserted_rows) {
			     $msg = "<div class='alert alert-success' role='alert'><strong>Success ! </strong>Payment added successfully.</div>";
			     return $msg;
			    } else {
			     $msg = "<div class='alert alert-danger' role='alert'><strong>Error ! </strong>Payment isn't added. Try again later.</div>";
			     return $msg;
			    }
			}			
		}

		public function getPaidUser(){
			$query = "SELECT * FROM tbl_payment ORDER BY id DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getUserMeal(){
			$query = "SELECT * FROM tbl_meal ORDER BY memberId ASC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getUserDeatails($memberId){
			$query = "SELECT * FROM tbl_member WHERE memberId='$memberId'";
    		$result = $this->db->select($query);
    		return $result;
		}

		public function delPaymentById($id){
			$delquery = "DELETE FROM tbl_payment WHERE id = '$id'";
			$deldata = $this->db->delete($delquery);
			if ($deldata) {
		    	$msg = "<div class='alert alert-warning' role='alert'><strong>Success ! </strong>Payment deleted successfully.</div>";
		    	return $msg;
		    } else {
		    	$msg = "<div class='alert alert-info' role='alert'><strong>Error ! </strong>Payment isn't deleted. Try again later.</div>";
		    	return $msg;
		    }
		}

		public function delAdminById($id){
			$delquery = "DELETE FROM tbl_admin WHERE adminId = '$id'";
			$deldata = $this->db->delete($delquery);
			if ($deldata) {
		    	$msg = "<div class='alert alert-warning' role='alert'><strong>Success ! </strong>User is removed from admin panel.</div>";
		    	return $msg;
		    } else {
		    	$msg = "<div class='alert alert-info' role='alert'><strong>Error ! </strong>User isn't removed. Try again later.</div>";
		    	return $msg;
		    }
		}

		public function onlyManagers(){
			$query = "SELECT * FROM tbl_admin WHERE role = '1' ORDER BY adminId ASC";
			$result = $this->db->select($query);
			return $result;
		}

		public function onlyCoManagers(){
			$query = "SELECT * FROM tbl_admin WHERE role = '2' ORDER BY adminId ASC";
			$result = $this->db->select($query);
			return $result;
		}

		public function onlySupervisers(){
			$query = "SELECT * FROM tbl_admin WHERE role = '3' ORDER BY adminId ASC";
			$result = $this->db->select($query);
			return $result;
		}

		public function bazarInsert($data){
	        $value  = $data['username'];
			$budget = $this->fm->validation($data['budget']);		
			$list   = $this->fm->validation($data['list']);	
			$date   = $this->fm->validation($data['date']);	

			$budget = mysqli_real_escape_string($this->db->link, $budget);
			$list   = mysqli_real_escape_string($this->db->link, $list);
			$date   = mysqli_real_escape_string($this->db->link, $date);

			if($value == "" || $budget == "" || $list == "" || $date == ""){
		    	$msg = "<div class='alert alert-danger' role='alert'><strong> Error ! </strong>Field field must not be empty.</div>";
				return $msg;
		    } else {
		    	$ids = array();
                foreach($value as $val){
	                $ids[] = $val;
	            }

			    $query = "INSERT INTO tbl_bazar(budget, username, list, date) 
			    VALUES('$budget', '" . implode(', ', $ids) . "', '$list', '$date')";
			    $inserted_rows = $this->db->insert($query);
			    if ($inserted_rows) {
			     $msg = "<div class='alert alert-success' role='alert'><strong>Success ! </strong>Bazar added successfully.</div>";
			     return $msg;
			    } else {
			     $msg = "<div class='alert alert-danger' role='alert'><strong>Error ! </strong>Bazar isn't added. Try again later.</div>";
			     return $msg;
			    }
			}
		}

		public function getEstimatedBazar(){
			$query = "SELECT * FROM tbl_bazar ORDER BY id DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function delBazarById($id){
			$delquery = "DELETE FROM tbl_bazar WHERE id = '$id'";
			$deldata = $this->db->delete($delquery);
			if ($deldata) {
		    	$msg = "<div class='alert alert-warning' role='alert'><strong>Success ! </strong>Predicted bazar deleted successfully.</div>";
		    	return $msg;
		    } else {
		    	$msg = "<div class='alert alert-info' role='alert'><strong>Error ! </strong>Predicted bazar isn't deleted. Try again later.</div>";
		    	return $msg;
		    }
		}

		public function getBazarById($id){
			$query = "SELECT * FROM tbl_bazar WHERE id = '$id'";
    		$result = $this->db->select($query);
    		return $result;
		}

		public function bazarUpdate($data, $id){
			$budget = $this->fm->validation($data['budget']);
			$list   = $this->fm->validation($data['list']);
			$date   = $this->fm->validation($data['date']);

			$budget = mysqli_real_escape_string($this->db->link, $budget);
			$list   = mysqli_real_escape_string($this->db->link, $list);
			$date   = mysqli_real_escape_string($this->db->link, $date);
			$id     = mysqli_real_escape_string($this->db->link, $id);


			if (empty($budget) || empty($list) || empty($date)){
				$msg = "<div class='alert alert-danger' role='alert'><strong>Error ! </strong>Field field must not be empty.</div>";
		    	return $msg;
			} else {
				$query = "UPDATE tbl_bazar
					      SET 
					      budget = '$budget',
						  list   = '$list',
						  date   = '$date'
					      WHERE id = '$id'";
				$updated_row = $this->db->update($query);
				if($updated_row){
					$msg = "<div class='alert alert-success' role='alert'><strong>Success ! </strong>Predicted bazar updated successfully.</div>";
		    		return $msg;
				} else {
					$msg = "<div class='alert alert-danger' role='alert'><strong>Error ! </strong>Bazar isn't updated. Try again later.</div>";
			     	return $msg;
				}
			}
		}

		public function expenseInsert($data){	
			$member   = $this->fm->validation($data['member']);	
			$username = $this->fm->validation($data['username']);	
			$expense  = $this->fm->validation($data['expense']);	
			$receipt  = $this->fm->validation($data['receipt']);
			$date     = $this->fm->validation($data['date']);

			$member   = mysqli_real_escape_string($this->db->link, $member);
			$username = mysqli_real_escape_string($this->db->link, $username);
			$expense  = mysqli_real_escape_string($this->db->link, $expense);
			$receipt  = mysqli_real_escape_string($this->db->link, $receipt);
			$date     = mysqli_real_escape_string($this->db->link, $date);

			if($member == "" || $expense == "" || $date == ""){
		    	$msg = "<div class='alert alert-danger' role='alert'><strong> Error ! </strong>Required field field must not be empty.</div>";
				return $msg;
		    } else {
			    $query = "INSERT INTO tbl_expense(member, username, expense, receipt, date) 
			    VALUES('$member', '$username', '$expense', '$receipt', '$date')";
			    $inserted_rows = $this->db->insert($query);
			    if ($inserted_rows) {
			     $msg = "<div class='alert alert-success' role='alert'><strong>Success ! </strong>Expenses added successfully to the database.</div>";
			     return $msg;
			    } else {
			     $msg = "<div class='alert alert-danger' role='alert'><strong>Error ! </strong>Expenses isn't added. Try again later.</div>";
			     return $msg;
			    }
			}
		}

		public function getExpense(){
			$query = "SELECT * FROM tbl_expense ORDER BY id DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function delExpenseById($id){
			$delquery = "DELETE FROM tbl_expense WHERE id = '$id'";
			$deldata = $this->db->delete($delquery);
			if ($deldata) {
		    	$msg = "<div class='alert alert-warning' role='alert'><strong>Success ! </strong>Expense removed successfully.</div>";
		    	return $msg;
		    } else {
		    	$msg = "<div class='alert alert-info' role='alert'><strong>Error ! </strong>Expense isn't removed. Try again later.</div>";
		    	return $msg;
		    }
		}

		public function getExpenseById($id){
			$query = "SELECT * FROM tbl_expense WHERE id = '$id'";
    		$result = $this->db->select($query);
    		return $result;
		}

		public function expenseUpdate($data, $id){
			$member   = $this->fm->validation($data['member']);
			$username = $this->fm->validation($data['username']);
			$expense  = $this->fm->validation($data['expense']);
			$receipt  = $this->fm->validation($data['receipt']);
			$date     = $this->fm->validation($data['date']);

			$member   = mysqli_real_escape_string($this->db->link, $member);
			$username = mysqli_real_escape_string($this->db->link, $username);
			$expense  = mysqli_real_escape_string($this->db->link, $expense);
			$receipt  = mysqli_real_escape_string($this->db->link, $receipt);
			$date     = mysqli_real_escape_string($this->db->link, $date);
			$id       = mysqli_real_escape_string($this->db->link, $id);


			if ($member == "" || $expense == "" || $date == ""){
				$msg = "<div class='alert alert-danger' role='alert'><strong>Error ! ★ </strong>marked field field must not be empty.</div>";
		    	return $msg;
			} else {
				$query = "UPDATE tbl_expense
					      SET 
					      member   = '$member',
						  username = '$username',
						  expense  = '$expense',
						  receipt  = '$receipt',
						  date     = '$date'
					      WHERE id = '$id'";
				$updated_row = $this->db->update($query);
				if($updated_row){
					$msg = "<div class='alert alert-success' role='alert'><strong>Success ! </strong>Expenses updated successfully.</div>";
		    		return $msg;
				} else {
					$msg = "<div class='alert alert-danger' role='alert'><strong>Error ! </strong>Expenses isn't updated. Try again later.</div>";
			     	return $msg;
				}
			}
		}

		public function mealInsert($current_date, $meal = array()){
			$query = "SELECT DISTINCT meal_time FROM tbl_meal";
			$getdata = $this->db->select($query);
			while ($result = $getdata->fetch_assoc()) {
				$db_date = $result['meal_time'];
				if($current_date == $db_date){
					$msg = "<div class='alert alert-warning' role='alert'><strong>Invalid ! </strong>Meal has been already submitted for today.</div>";
			     	return $msg;
				}
			}

			foreach ($meal as $key => $value) {
				if ($value == "0.0") {
					$meal_query = "INSERT INTO tbl_meal(memberId, meal, meal_time) VALUES('$key', '0.0', now())";
					$data_insert = $this->db->insert($meal_query);
				} elseif ($value == "0.5") {
					$meal_query = "INSERT INTO tbl_meal(memberId, meal, meal_time) VALUES('$key', '0.5', now())";
					$data_insert = $this->db->insert($meal_query);
				} elseif ($value == "1.0") {
					$meal_query = "INSERT INTO tbl_meal(memberId, meal, meal_time) VALUES('$key', '1.0', now())";
					$data_insert = $this->db->insert($meal_query);
				} elseif ($value == "1.5") {
					$meal_query = "INSERT INTO tbl_meal(memberId, meal, meal_time) VALUES('$key', '1.5', now())";
					$data_insert = $this->db->insert($meal_query);
				} elseif ($value == "2.0") {
					$meal_query = "INSERT INTO tbl_meal(memberId, meal, meal_time) VALUES('$key', '2.0', now())";
					$data_insert = $this->db->insert($meal_query);
				} elseif ($value == "2.5") {
					$meal_query = "INSERT INTO tbl_meal(memberId, meal, meal_time) VALUES('$key', '2.5', now())";
					$data_insert = $this->db->insert($meal_query);
				} elseif ($value == "3.0") {
					$meal_query = "INSERT INTO tbl_meal(memberId, meal, meal_time) VALUES('$key', '3.0', now())";
					$data_insert = $this->db->insert($meal_query);
				} elseif ($value == "3.5") {
					$meal_query = "INSERT INTO tbl_meal(memberId, meal, meal_time) VALUES('$key', '3.5', now())";
					$data_insert = $this->db->insert($meal_query);
				} elseif ($value == "4.0") {
					$meal_query = "INSERT INTO tbl_meal(memberId, meal, meal_time) VALUES('$key', '4.0', now())";
					$data_insert = $this->db->insert($meal_query);
				} elseif ($value == "4.5") {
					$meal_query = "INSERT INTO tbl_meal(memberId, meal, meal_time) VALUES('$key', '4.5', now())";
					$data_insert = $this->db->insert($meal_query);
				} elseif ($value == "5.0") {
					$meal_query = "INSERT INTO tbl_meal(memberId, meal, meal_time) VALUES('$key', '5.0', now())";
					$data_insert = $this->db->insert($meal_query);
				}
			}

			if($data_insert){
				$msg = "<div class='alert alert-success' role='alert'><strong>Success ! </strong>Today's meal added to the database.</div>";
			     return $msg;
			} else {
				$msg = "<div class='alert alert-danger' role='alert'><strong>Error ! </strong>Meal isn't added. Try again later.</div>";
			     return $msg;
			}
		}

		public function getMealHistory(){
			$query = "SELECT DISTINCT meal_time FROM tbl_meal";
			$result = $this->db->select($query);
			return $result;
		}

		public function getAllByDate($dt){
			$query = "SELECT tbl_member.username, tbl_meal.*
					  FROM tbl_member
					  INNER JOIN tbl_meal
					  ON tbl_member.memberId = tbl_meal.memberId
					  WHERE meal_time = '$dt'";
			$result = $this->db->select($query);
			return $result;			
		}

		public function mealUpdate($dt, $meal){
			foreach ($meal as $key => $value) {
				if ($value == "0.0"){
					$query = "UPDATE tbl_meal SET meal = '0.0' WHERE memberId = '".$key."' AND meal_time = '".$dt."'";
					$data_update = $this->db->update($query);
				} elseif ($value == "0.5"){
					$query = "UPDATE tbl_meal SET meal = '0.5' WHERE memberId = '".$key."' AND meal_time = '".$dt."'";
					$data_update = $this->db->update($query);
				} elseif ($value == "1.0"){
					$query = "UPDATE tbl_meal SET meal = '1.0' WHERE memberId = '".$key."' AND meal_time = '".$dt."'";
					$data_update = $this->db->update($query);
				} elseif ($value == "1.5"){
					$query = "UPDATE tbl_meal SET meal = '1.5' WHERE memberId = '".$key."' AND meal_time = '".$dt."'";
					$data_update = $this->db->update($query);
				} elseif ($value == "2.0"){
					$query = "UPDATE tbl_meal SET meal = '2.0' WHERE memberId = '".$key."' AND meal_time = '".$dt."'";
					$data_update = $this->db->update($query);
				} elseif ($value == "2.5"){
					$query = "UPDATE tbl_meal SET meal = '2.5' WHERE memberId = '".$key."' AND meal_time = '".$dt."'";
					$data_update = $this->db->update($query);
				} elseif ($value == "3.0"){
					$query = "UPDATE tbl_meal SET meal = '3.0' WHERE memberId = '".$key."' AND meal_time = '".$dt."'";
					$data_update = $this->db->update($query);
				} elseif ($value == "3.5"){
					$query = "UPDATE tbl_meal SET meal = '3.5' WHERE memberId = '".$key."' AND meal_time = '".$dt."'";
					$data_update = $this->db->update($query);
				} elseif ($value == "4.0"){
					$query = "UPDATE tbl_meal SET meal = '4.0' WHERE memberId = '".$key."' AND meal_time = '".$dt."'";
					$data_update = $this->db->update($query);
				} elseif ($value == "4.5"){
					$query = "UPDATE tbl_meal SET meal = '4.5' WHERE memberId = '".$key."' AND meal_time = '".$dt."'";
					$data_update = $this->db->update($query);
				} elseif ($value == "5.0"){
					$query = "UPDATE tbl_meal SET meal = '5.0' WHERE memberId = '".$key."' AND meal_time = '".$dt."'";
					$data_update = $this->db->update($query);
				}
			}

			if($data_update){
				$msg = "<div class='alert alert-success' role='alert'><strong>Success ! </strong>Meal updated into the database.</div>";
			     return $msg;
			} else {
				$msg = "<div class='alert alert-danger' role='alert'><strong>Error ! </strong>Meal isn't updated. Try again later.</div>";
			     return $msg;
			}
		}

		public function getTotalMeal(){
			$query = "SELECT * FROM tbl_meal";
			$result = $this->db->select($query);
			return $result;
		}
	}
