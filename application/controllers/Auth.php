<?php

class Auth extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        //validate the form data 
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        // if validation fails
        if ($this->form_validation->run() == FALSE) {
            // back to login page
            $this->load->view('v_login');
        }   //  if validation is successful
        else {
            $this->_login();
        }
    }

    // function login
    private function _login()
    {
        // get value email n pass
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // get value email from db
        $user =  $this->db->get_where('account', ['email' => $email])->row_array();

        // if acccont has registered
        if ($user) {
            // if user active
            if ($user['is_active'] == 1) {
                // check password (if true)
                if (password_verify($password, $user['password'])) {
                    // set session data 
                    $data = [
                        'nama' => $user['nama'],
                        'jenis_kelamin' => $user['jenis_kelamin'],
                        'no_tlp' => $user['no_tlp'],
                        'alamat' => $user['alamat'],
                        'email' => $user['email'],
                        'foto' => $user['foto'],
                    ];
                    $this->session->set_userdata($data);
                    $this->session->set_userdata('masuk', TRUE);
                    // move to dahboard page
                    redirect('dashboard');
                } // if false password
                else {
                    // set notification if false password
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Email / Password Salah! </div>');
                    // move to login page
                    redirect('auth');
                }
            } // if user not active
            else {
                // set nofification if user not active
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Email belum diaktivasi! </div>');
                // move to login page
                redirect('auth');
            }
        }
        // if acccont hasn't registered
        else {
            // set nofification if user not registered
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Email tidak terdaftar! </div>');
            redirect('auth');
        }
    }


    // function registation
    public function registration()
    {
        //validate the form data 
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
        $this->form_validation->set_rules(
            'no_tlp',
            'Telepon',
            'required|is_unique[account.no_tlp]',
            ['is_unique' => "* Nomor sudah terdaftar!"]
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|is_unique[account.email]',
            ['is_unique' => "* Email sudah terdaftar!"]
        );
        $this->form_validation->set_rules('alamat', 'trim|Alamat Rumah', 'required');
        $this->form_validation->set_rules('password', 'trim|Password', 'required');

        //configuration upload file
        // file storage of "foto"
        $config['upload_path']          = APPPATH . '../upload';
        // allowed types files upload
        $config['allowed_types']        = 'jpg|png|jpeg';
        // set maxsize file upload (kb)
        $config['max_size']             = 100000;
        //load library upload
        $this->load->library('upload', $config);

        //  if not upload photo
        if (!$this->upload->do_upload('foto')) {
            //
        } // if upload photo 
        else {
            // process uploading
            $upload_data = $this->upload->data();
            //set the uploaded file 
            $file['foto'] = $upload_data['file_name'];
        }

        // create validation forms
        //  if validation fails
        if ($this->form_validation->run() == FALSE) {
            // back to register page
            $this->load->view('v_regist');
        }   //  if validation is successful
        else {
            // get value from input field
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama')),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'no_tlp' => htmlspecialchars($this->input->post('no_tlp')),
                'email' => htmlspecialchars($this->input->post('email')),
                'alamat' => htmlspecialchars($this->input->post('alamat')),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'foto' =>  $file['foto'],
                'is_active' => 0,
                'created' => time()
            ];


            // set email value
            $email = $this->input->post('email');
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'created' => time()
            ];



            // insert data to database account
            $this->db->insert('account', $data);

            // insert data to database token
            $this->db->insert('user_token', $user_token);

            // send token by email input
            $this->_sendEmail($token, 'verify');


            // set notification if success regist
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> Akun berhasil dibuat, Cek email untuk aktivasi!  </div>');
            redirect('auth');
        }
    }

    // function send email
    private function _sendEmail($token, $type)
    {
        // configuration server email
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'mail@alfiansyahcwicaksono.rekayasatu.com',
            'smtp_pass' => 'jwpcoralis2023',
            'smptp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        // load email library
        $this->load->library('email', $config);

        // configuration send email
        $this->email->from('mail@alfiansyahcwicaksono.rekayasatu.com', 'Admin JWP ');
        $this->email->to($this->input->post('email'));

        // if verify true
        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify your account <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Active</a>');
        } elseif ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        }


        // send email
        if ($this->email->send()) {
            return TRUE;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user =  $this->db->get_where('account', ['email' => $email])->row_array();

        // if email validation true 
        if ($user) {
            $user_token =  $this->db->get_where('user_token', ['token' => $token])->row_array();

            // if token validation true
            if ($user_token) {
                // validation time 
                if (time() - $user_token['created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('account');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> Aktivasi Berhasil : Silahkan Login!  </div>');
                    redirect('auth');
                } else {
                    $this->db->delete('account', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> Aktivasi Akun Gagal : Token Expired!  </div>');
                    redirect('auth');
                }
            }     // if token validation wrong
            else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> Aktivasi Akun Gagal : Token Salah!  </div>');
                redirect('auth');
            }
        } // if email validation wrong 
        else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> Aktivasi Akun Gagal : Email Salah!  </div>');
            redirect('auth');
        }
    }

    // function forgotpassword
    public function forgotPassword()
    {
        //validate the form data 
        $this->form_validation->set_rules('email', 'Email', 'required|trim');

        // create validation forms
        //  if validation fails
        if ($this->form_validation->run() == FALSE) {
            // back to forgotpass page
            $this->load->view('v_forgotpass');
        }   //  if validation is successful
        else {

            $email = $this->input->post('email');
            $user = $this->db->get_where('account', ['email' => $email, 'is_active' => 1])->row_array();

            // if email avaiable registered
            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> Cek email untuk reset password! </div>');
                redirect('auth/forgotpassword');
            }
            // if email n'tavailale
            else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> Email tidak terdaftar atau belum aktivasi!  </div>');
                redirect('auth/forgotpassword');
            }
        }
    }

    public function resetpassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user =  $this->db->get_where('account', ['email' => $email])->row_array();

        // if validation email true
        if ($user) {
            $user_token =  $this->db->get_where('user_token', ['token' => $token])->row_array();
            // if validation token true
            if ($user_token) {
                // set userdata
                $this->session->set_userdata('reset_password', $email);
                // function change password
                $this->changePassword();
            } // if validation token fails
            else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> Reset Password Gagal : Token Salah!  </div>');
                redirect('auth/forgotpasword');
            }
        } // if validation email fails
        else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"> Reset Password Gagal : Email Salah!  </div>');
            redirect('auth/forgotpassword');
        }
    }

    public function changePassword()
    {
        
        
        //validate the form data 
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        // create validation forms
        //  if validation fails
        if ($this->form_validation->run() == FALSE) {
            // back to register page
            $this->load->view('v_resetpass');
        }   //  if validation is successful
        else {
            $password =  password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $email = $this->session->set_userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('account');

            $this->db->delete('user_token', ['email' => $email]); 

            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"> Reset Password Berhasil : Silahkan Login!  </div>');
            redirect('auth');
        }
    }

    // function logout
    function logout()
    {
        $this->session->sess_destroy();
        $url = base_url('');
        redirect($url);
    }
}
