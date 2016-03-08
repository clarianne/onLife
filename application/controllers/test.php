							<html>
							<head>
							<title>Update Data In Database Using CodeIgniter</title>
							<link href='http://fonts.googleapis.com/css?family=Marcellus' rel='stylesheet' type='text/css'>
							<link rel="stylesheet" type="text/css" href="<?php echo base_url(). "css/update.css" ?>">
							</head>
							<body>
							<div id="container">
							<div id="wrapper">
							<h1>Update Data In Database Using CodeIgniter </h1><hr/>
							<div id="menu">
							<p>Click On Menu</p>
							<!-- Fetching Names Of All Students From Database -->
							<ol>
							<?php foreach ($students as $student): ?>
							<li><a href="<?php echo base_url() . "index.php/update_ctrl/show_student_id/" . $student->student_id; ?>"><?php echo $student->student_name; ?></a></li>
							<?php endforeach; ?>
							</ol>
							</div>
							<div id="detail">
							<!-- Fetching All Details of Selected Student From Database And Showing In a Form -->
							<?php foreach ($single_student as $student): ?>
							<p>Edit Detail & Click Update Button</p>
							<form method="post" action="<?php echo base_url() . "index.php/update_ctrl/update_student_id1"?>">
							<label id="hide">Id :</label>
							<input type="text" id="hide" name="did" value="<?php echo $student->student_id; ?>">
							<label>Name :</label>
							<input type="text" name="dname" value="<?php echo $student->student_name; ?>">
							<label>Email :</label>
							<input type="text" name="demail" value="<?php echo $student->student_email; ?>">
							<label>Mobile :</label>
							<input type="text" name="dmobile" value="<?php echo $student->student_mobile; ?>">
							<label>Address :</label>
							<input type="text" name="daddress" value="<?php echo $student->student_address; ?>">
							<input type="submit" id="submit" name="dsubmit" value="Update">
							</form>
							<?php endforeach; ?>
							</div>
							</div>
							</div>
							</body>
							</html>

							//controller

							<?php
							class update_ctrl extends CI_Controller{
							function __construct(){
							parent::__construct();
							$this->load->model('update_model');
							}
							function show_student_id() {
							$id = $this->uri->segment(3);
							$data['students'] = $this->update_model->show_students();
							$data['single_student'] = $this->update_model->show_student_id($id);
							$this->load->view('update_view', $data);
							}
							function update_student_id1() {
							$id= $this->input->post('did');
							$data = array(
							'Student_Name' => $this->input->post('dname'),
							'Student_Email' => $this->input->post('demail'),
							'Student_Mobile' => $this->input->post('dmobile'),
							'Student_Address' => $this->input->post('daddress')
							);
							$this->update_model->update_student_id1($id,$data);
							$this->show_student_id();
							}
							}
							?>

							//model
							<?php
							class update_model extends CI_Model{
							// Function To Fetch All Students Record
							function show_students(){
							$query = $this->db->get('students');
							$query_result = $query->result();
							return $query_result;
							}
							// Function To Fetch Selected Student Record
							function show_student_id($data){
							$this->db->select('*');
							$this->db->from('students');
							$this->db->where('student_id', $data);
							$query = $this->db->get();
							$result = $query->result();
							return $result;
							}
							// Update Query For Selected Student
							function update_student_id1($id,$data){
							$this->db->where('student_id', $id);
							$this->db->update('students', $data);
							}
							}
							?>