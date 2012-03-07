<?php

/****************************************************************/
/* EGs Web Panel (Web Services for Atheme)                      */
/*                                                              */
/* author: 	J. Newing (synmuffin)                               */
/* web:		http://egs.ircmojo.org                              */
/* email: 	jnewing [at] gmail [dot] com                        */
/* irc: 	pool.ircmojo.org                                    */
/* version: 3.1                                                 */
/****************************************************************/


/**
 * Chanserv Controller
 * 
 */
class Chanserv extends CI_Controller {
	
	//========================================================
	// PRIVATE VARS
	//========================================================
	
	
	//========================================================
	// PUBLIC VARS
	//========================================================
	
	
	//========================================================
	// PUBLIC FUNCTIONS
	//========================================================

	
	/**
	 * Constructor
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		
		if (!$this->session->userdata('is_authed'))
			redirect('main');
	}
	// --------------------------------------------------------
	
	
	/**
	 * Index Page
	 *
	 */
	public function index()
	{
		// durp?
	}
	// --------------------------------------------------------
	
	
	/**
	 * Chanserv Info Page
	 * Page displayes info on the user requested channel.
	 *
	 */
	public function info()
	{
		$page_data = array();
		
		$this->form_validation->set_rules('channel', 'Channel Name', 'required|callback__valid_channel');
		
		if ($this->form_validation->run())
		{
			$callback = $this->chanserv_model->channel_info($this->input->post('channel'));
			
			if (!$callback['response'] && $callback['data'] == $this->lang->line('error_invalid_authcookie'))
				redirect('main/logout');
			
			$page_data['response'] = $callback['data'];
				
		}
		
		
		$this->load->view('chanserv/info', $page_data);
	}
	// --------------------------------------------------------
	
	
	/**
	 * Chanserv Topic Page
	 * Page allows users to view and set topic of a specified channel
	 * 
	 */
	public function topic()
	{
		$page_data = array();
		
		$this->form_validation->set_rules('channel', 'Channel Name', 'required|callback__valid_channel');
		$this->form_validation->set_rules('topic', 'Channel Topic', 'required');
		
		if ($this->form_validation->run())
		{
			$callback = $this->chanserv_model->channel_topic($this->input->post('channel'), $this->input->post('topic'));
			
			if (!$callback['response'] && $callback['data'] == $this->lang->line('error_invalid_authcookie'))
				redirect('main/logout');
				
			$page_data['success'] = $callback['response'];
			$page_data['msg'] = $callback['data'];
		}
		
		$this->load->view('chanserv/topic', $page_data);
	}
	// --------------------------------------------------------
	
	
	/**
	 * Chanserv Kick Page
	 * Page allows user to kick a specified user from a specified channel
	 *
	 */
	public function kick()
	{
		$page_data = array();
		
		$this->form_validation->set_rules('channel', 'Channel Name', 'required|callback__valid_channel');
		$this->form_validation->set_rules('nick', 'Nickname', 'required');
		
		if ($this->form_validation->run())
		{
			$callback = $this->chanserv_model->channel_kick($this->input->post('channel'), $this->input->post('nick'), $this->input->post('reason'));
			
			if (!$callback['response'] && $callback['data'] == $this->lang->line('error_invalid_authcookie'))
				redirect('main/logout');
				
			$page_data['success'] = $callback['response'];
			$page_data['msg'] = $callback['data'];
		}
		
		$this->load->view('chanserv/kick', $page_data);
	}
	// --------------------------------------------------------
	
	
	/**
	 * Chanserv Ban Page
	 * Page allows users to manage bans for a specified channel
	 *
	 */
	public function ban()
	{
		$page_data = array();
		
		$this->form_validation->set_rules('channel', 'Channel Name', 'required|callback__valid_channel');
		$this->form_validation->set_rules('nick', 'Nickname', 'required');
		
		if ($this->form_validation->run())
		{
			if ($this->input->post('unban') == 1)
			{
				$callback = $this->chanserv_model->channel_ban($this->input->post('channel'), $this->input->post('nick'), TRUE);
			}
			else
			{
				$callback = $this->chanserv_model->channel_ban($this->input->post('channel'), $this->input->post('nick'));
			}
						
			if (!$callback['response'] && $callback['data'] == $this->lang->line('error_invalid_authcookie'))
				redirect('main/logout');
				
			$page_data['success'] = $callback['response'];
			$page_data['msg'] = $callback['data'];
		}
		
		$this->load->view('chanserv/ban', $page_data);
	}
	// --------------------------------------------------------
	
	
	/**
	 * Chanserv Flags Page
	 * Page allows user to manage channel flags for a specified channel
	 * 
	 */
	public function flags()
	{
		$page_data = array();
		
		if ($this->input->post('list_flags'))
		{
			$this->form_validation->set_rules('channel', 'Channel name', 'required|callback__valid_channel');
		}
		
		if ($this->input->post('set_flags'))
		{
			$this->form_validation->set_rules('channel', 'Channel name', 'required|callback__valid_channel');
			$this->form_validation->set_rules('nick', 'Nickname or hostmask', 'required');
			$this->form_validation->set_rules('flags', 'Flags', 'required');
		}
		
		if ($this->form_validation->run())
		{
			
			if ($this->input->post('list_flags'))
			{
				$callback = $this->chanserv_model->channel_flags_list($this->input->post('channel'));
				
				if (!$callback['response'] && $callback['data'] == $this->lang->line('error_invalid_authcookie'))
					redirect('main/logout');
				
				$page_data['response'] = $callback['data']; 
			}
			
			if ($this->input->post('set_flags'))
			{
				$callback = $this->chanserv_model->channel_flags_set($this->input->post('channel'), $this->input->post('nick'), $this->input->post('flags'));
				
				if (!$callback['response'] && $callback['data'] == $this->lang->line('error_invalid_authcookie'))
					redirect('main/logout');
								
				$page_data['success'] = $callback['response'];
				$page_data['msg'] = $callback['data'];
			}
			
		}
		
		$this->load->view('chanserv/flags', $page_data);
	}
	// --------------------------------------------------------


	/**
	 * Chanserv XOP Page
	 * Page allows users to manage channel flags via the XOP system, this page will only
	 * be display if $config['atheme_xop'] is set to TRUE.
	 * 
	 */
	public function xop()
	{
		$page_data = array();

		// setup form rules for xop list
		if ($this->input->post('list_xop'))
			$this->form_validation->set_rules('xop_channel', 'Channel', 'required');

		// set form rules for xop management
		if ($this->input->post('set_xop'))
		{
			$this->form_validation->set_rules('xop_channel', 'Channel', 'required');
			$this->form_validation->set_rules('xop_nick', 'Nickname or Hostmask', 'required');
		}

		// did the user submit?
		if ($this->form_validation->run())
		{
			// are we getting a list?
			if ($this->input->post('list_xop'))
			{
				$callback = $this->chanserv_model->channel_xop($this->input->post('xop_type'), $this->input->post('xop_channel'), "LIST");

				// check for valid call
				if (!$callback['response'] && $callback['data'] == $this->lang->line('error_invalid_authcookie'))
					redirect('main/logout');
				
				$page_data['response'] = $callback['data'];
			}

			// are we managing our XOP list
			if ($this->input->post('set_xop'))
			{
				$callback = $this->chanserv_model->channel_xop($this->input->post('xop_type'), $this->input->post('xop_channel'), $this->input->post('xop_action'), $this->input->post('xop_nick'));

				// check for valid call
				if (!$callback['response'] && $callback['data'] == $this->lang->line('error_invalid_authcookie'))
					redirect('main/logout');
				
				// atheme response
	            $page_data['success'] = $callback['response'];
				$page_data['msg'] = $callback['data'];
			}
		}


		$this->load->view('chanserv/xop', $page_data);
	}
	// --------------------------------------------------------
	
	
	/**
	 * Chanserv AKick Page
	 * Page allows users to manage their channel auto-kicks (akick)
	 * 
	 */
    public function akick()
    {
        $page_data = array();

        if ($this->input->post('list_akicks'))
        {
            $this->form_validation->set_rules('channel', 'Channel name', 'required|callback__valid_channel');
        }

        if ($this->input->post('set_akick'))
        {
            $this->form_validation->set_rules('channel', 'Channel name', 'required|callback__valid_channel');
            $this->form_validation->set_rules('nick', 'Nick or hostmask', 'required');
            $this->form_validation->set_rules('action', 'AKick action', 'required');
        }

        if ($this->form_validation->run())
        {
            if ($this->input->post('list_akicks'))
            {
                $callback = $this->chanserv_model->channel_akick_list($this->input->post('channel'));
                
                if (!$callback['response'] && $callback['data'] == "Invalid authcookie for this account.")
                    redirect('main/logout');
				
				$page_data['response'] = $callback['data'];
            }

            if ($this->input->post('set_akick'))
            {
                $callback = $this->chanserv_model->channel_akick_set($this->input->post('channel'), $this->input->post('action'), $this->input->post('nick'), $this->input->post('reason'));
                
                if (!$callback['response'] && $callback['response'] == "Invalid authcookie for this account.")
                    redirect('main/logout');
                
                $page_data['success'] = $callback['response'];
				$page_data['msg'] = $callback['data'];
            }
        }
        
        $this->load->view('chanserv/akick', $page_data);
    }
    // --------------------------------------------------------
	
	
	//========================================================
	// CALLBACK FUNCTIONS
	//========================================================
	
	
	/**
	 * _valid_channel
	 * Function checks to see if a passed channel name needs a # prepended to it or not.
	 *
	 * @access public
	 * @param string $str - string of a channel name
	 * @return $str with pre-peneded #
	 *
	 */
	public function _valid_channel($str)
	{
		if (substr($str, 0, 1) != '#')
			return $str = "#" . $str;
	}
	
	
	//========================================================
	// PRIVATE FUNCTIONS
	//========================================================
	
}
