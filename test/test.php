<?php
	/*
	Plugin Name: WordPress-SharpSpring-Integration
	Plugin URI: https://efe.com.vn/
	Description: admin can turn on and off the tracking code. If the "Enable Tracking" option is on, then the "SharpSpring tracking code" will be inserted into the theme file above end of </body> tag.
	Version: 1.0
	Author: Sang
	License: GPL
	*/  
?>
<?php
	if(!class_exists('test')){
		class test{
			public $notify;
			public function __construct(){
				add_action('admin_menu',array($this,'menu'));
				add_action( 'wp_footer',    array( $this, 'add_code' ) );
				//add_action( 'wp_footer',    array( $this, 'add' ) );
			}
			public function menu(){
				add_submenu_page("options-general.php","shark","shark","manage_options","menu_test",array($this,'check'));
			}
			public function check(){
				if(isset($_POST['submit'])){
					if(!empty($_POST['data_code']) && empty($_POST['data_disable'])){
						update_option('shark_code',$_POST['data_code']);
						$this->notify;
					}else  if(!empty($_POST['data_disable'])){
						delete_option('shark_code');
					}
				}
				$this->form();
			}
			function add_code()
			{
					$data=get_option('shark_code');
					echo $data;

			}
			// public function add(){
			// 	echo '<p>This is inserted at the bottom</p>';
			// }
			public function form(){ ?>

				<div class="wrap">  
				    <form method="POST" action="">
				        <h2>Shark Code</h2>
				        <p>Add code footer section.</p>
				            <div class="updated"><p><strong><?php if(!empty($this->notify)) echo "add successfully"; ?></strong></p></div>
				        <p>
				            <h3>footer</h3>
				            <textarea rows="10" cols="100" style="width: 100%;" name="data_code" value="">  	
				            </textarea>
				            <br />
				            <input type="checkbox" name="data_disable" /><br/>
				            <label for="lb_disable">Disable code</label>
				        </p>

				        <p><br /></p>
				        <p><input class="button-primary" type="submit" name="submit" value="Add code"/></p>
				    </form>
				</div>

		<?php	}
		}
	}
	$a=new test();
?>