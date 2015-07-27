<? php

public function lfsiid_check ($str) {
		if (preg_match('/^[0-9]+$/',$str)) return true;
		else return false;
	}
	/*
	*	Function that checks the input lfsiid.
	*/
	public function check_lfsiid(){
		$lfsi_id = $this->input->post('lfsi_id');
		$preclass = $this->input->post('preclass');
		$new_lfsi_id = $preclass . $lfsi_id;
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('lfsi_id', 'lfsi_ID','trim|required|xss_clean|callback_lfsiid_check');

		if ($this->form_validation->run() == false){
			echo '3';
		}
		else {
			$this->load->model('administration/check_input_model');
			$num_lfsiID = $this->check_input_model->check_lfsiid($preclass, $lfsi_ID);
			
			if (intval($num_lfsiID) == 0) {
				echo '1';
			}
			else echo '2';
		}
	}
	/*
	*	Function that checks the new input materialid.
	*/
	public function check_new_materialid(){
		$materialid = $this->input->post('materialid');
		$preclass = $this->input->post('preclass');
		$new_matID = $preclass . $materialid;
		$previous_matID = $this->input->post('previous_matID');
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('materialid', 'materialID','trim|required|xss_clean|callback_materialid_check');

		if ($this->form_validation->run() == false){
			echo '3';
		}
		else if ($previous_matID == $new_matID){
			echo '1';
		}
		else {
			$this->load->model('admin/check_input_model');
			$num_matID = $this->check_input_model->check_materialid($preclass, $materialid);
			if (intval($num_matID) == 0) {
				echo '1';
			}
			else echo '2';
		}
	}

	?>