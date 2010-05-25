<?php include_once('./includes/funcoes.php'); logado();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ISP-Safe <?php include('VERSION'); ?></title>
<link href="css/estilos.css" rel="stylesheet" type="text/css" />

</head>

<body>
<SCRIPT type="text/javascript" src="includes/md5.js" > </SCRIPT>
<form id="frmAutenticacao" name="frmAutenticacao" method="POST" action="login.php">

 <div id='loginContainer' >
         <div id='loginHeader' >
            <div class='logoLogin' >
            </div>
         </div>
         <div id='loginContent' >
            <p class='loginTitle' >
               Bem-vindo ao ISP-Safe.
            </p>

            <p class='loginDescription' >
               Para efetuar o login no sistema informe seu login e senha nos campos abaixo.
            </p>
            <form action='login.php'  method='POST' >
		<div id="loginCampos">
                  <p class='inputField'>
                     <label for='txtLogin'>Login:</label><input id='txtLogin'  name='txtLogin' type='text' />
                  </p>
                  <p class='inputField'>
                     <label for='txtSenha'>Senha:</label><input id='txtSenha'  name='txtSenha' type='password' />
                  </p>

		
               <div id='buttons' >

                  <input name='Login'  type='submit'  value='Login'  onclick="document.getElementById('txtSenha').value=hex_md5(document.getElementById('txtSenha').value);" />

				<?php echo msgErro($_GET['msg']); ?>
               </div>
		</div>
            </form>
            <br/>
            <p class='loginDescription' >
               Version: <?php include('VERSION'); ?>
            </p>

         

         <div id='loginFooter' >
         </div>
      


</form>
</body>
</html>
