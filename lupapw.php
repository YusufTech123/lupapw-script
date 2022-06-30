<?php
 
require './wp-blog-header.php';
 
function meh() {
    global $wpdb;
 
    if ( isset( $_POST['update'] ) ) {

        $username = ( empty( $_POST['e-name'] ) ? '' : sanitize_user( $_POST['e-name'] ) );
        $password  = ( empty( $_POST[ 'e-pass' ] ) ? '' : $_POST['e-pass'] );
        $input = ( empty( $username ) ? '<div id="message" class="updated fade"><p><strong>Kolom username tidak boleh kosong.</strong></p></div>' : '' );
        $input .= ( empty( $password ) ? '<div id="message" class="updated fade"><p><strong>kolom password tidak boleh kosong.</strong></p></div>' : '' );
    
        if ( $username != $wpdb->get_var( "SELECT user_login FROM $wpdb->users WHERE ID = '1' LIMIT 1" ) ) {
            $input .="<div id='message' class='updated fade'><p><strong>nama username yang anda masukkan salah.</strong></p></div>";
        }
        if ( empty( $input ) ) {
            $wpdb->query( "UPDATE $wpdb->users SET user_pass = MD5('$password'), user_activation_key = '' WHERE user_login = '$username'" );
            $plaintext_pass = $password;
            @wp_mail( get_option( 'admin_email' ), sprintf(  get_option( 'blogname' ) ), $message );
        }
    }
 
    return empty( $input ) ? false : $input;
  }
 
$input = meh();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>YusufTech | WordPress Password Reset</title>
    <meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
    <link rel="stylesheet" href="<?php bloginfo( 'wpurl' ); ?>/wp-admin/wp-admin.css?version=<?php bloginfo( 'version' ); ?>" type="text/css" />
    <style>
      body {
        margin: 0;
        padding: 0;
        background-color: rgb(255, 255, 255);
      }

      #judul {
        margin-top: 50px;
        text-align: center;
        color: rgb(83, 81, 81);
        font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
      }

      .form {
        text-align: center;
        background-color: rgb(226, 226, 226);
        padding: 20px 20px 20px 20px;
        width: 400px;
        border-radius: 5px 5px 5px 5px;
        margin: 50px auto;
        box-shadow: 0px 20px 50px 0px rgb(155, 155, 155);
      }

      #judul2 {
        text-align: center;
        color: rgb(255, 81, 81);
        font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
      }

      #sub {
        width: 200px;
        margin-top: 20px;
        height: 40px;
        background-color: rgb(0, 102, 197);
        border: none;
        color: #fff;
        font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
      }

      #judul3 {
        margin-top: 30px;
        color: rgb(83, 81, 81);
        font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
      }

      #judul4 {
        color: rgb(83, 81, 81);
        margin-top: 20px;
        font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
      }

      #e-name {
        width: 300px;
        border: none;
        height: 20px;
        background-color: rgb(226, 226, 226);
        border-bottom: 1px solid black;
      }

      #e-pass {
        width: 300px;
        border: none;
        margin-bottom: 20px;
        height: 20px;
        background-color: rgb(226, 226, 226);
        border-bottom: 1px solid black;
      }

      #e-name:hover {
        border: none;
        background-color: rgb(226, 226, 226);
        border-bottom: 2px solid rgb(255, 102, 102);
      }

      #e-pass:hover {
        border: none;
        background-color: rgb(226, 226, 226);
        border-bottom: 2px solid rgb(255, 102, 102);
      }

      #sub:hover {
        width: 200px;
        margin-top: 20px;
        height: 40px;
        background-color: rgb(0, 71, 138);
        transition: all 0.5s;
        cursor: pointer;
        border: none;
        color: grey;
      }

      .footer {
        background-color: rgb(58, 58, 58);
        color: #fff;
        padding-top: 30px;
        padding-bottom: 30px;
        margin-top: 200px;
      }

      #judul-footer {
        font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
        display: inline;
      }

      .judul-pertama {
        margin-left: 15px;
      }

      .judul-terakhir {
        float: right;
        margin-top: 0px;
        margin-right: 15px;
      }

      .pemberitahuan {
        text-align: center;
        color: rgb(255, 102, 102);
        font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
        width: 350px;
        padding: 20px 0px 20px 0px;
        margin: 0 auto;
      }
    </style>
  </head>
  <body>
    <h2 id="judul">ISI FORM DIBAWAH UNTUK MERESET PASSWORD WORDPRESS ANDA</h2>
    <div class="form">
      <form method="post" action="">
        <h2 id="judul2">FORM RESET PASSWORD</h2>
        <p></p>
        <legend id="judul3">Username Lama</legend>
        <label
          ><br />
          <input type="text" name="e-name" id="e-name" class="input" value="<?php echo attribute_escape( stripslashes( $_POST['e-name'] ) ); ?>" size="20" tabindex="10"
        /></label>
        <legend id="judul4">Password Baru</legend>
        <label
          ><br />
          <input type="text" name="e-pass" id="e-pass" class="input" value="<?php echo attribute_escape( stripslashes( $_POST['e-pass'] ) ); ?>" size="25" tabindex="20"
        /></label>
        <p class="update-pass"><input id="sub" type="submit" name="update" value="Perbarui Pengaturan" /></p>
      </form>
    </div>
    <div class="pemberitahuan"><?php echo $input; ?></div>
    <div class="footer">
      <h5 id="judul-footer" class="judul-pertama">YusufTech | All Rights Reserved</h5>
      <h5 id="judul-footer" class="judul-terakhir">Programmer By : Yusuf Ghazali</h5>
    </div>
  </body>
</html>
<?php exit; ?>