<!DOCTYPE html>
<html>
<head>
<meta >
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

#user, #contra {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid rgba(165, 190, 223, 0.877);
  box-sizing: border-box;
}

.verde{
  background-color: rgba(0, 255, 0, 0.15)
}
.rojo{
  background-color: rgba(255, 0, 0, 0.15)
}
button {
  background-color: #2f5cbd;
  color: rgb(255, 255, 255);
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}
.fotouca {
  text-align: center;
  margin: auto;
}
div {
  background-color: lightgrey;
  width: 700px;
  padding: 50px;
  margin: auto;
  
}
</style>
</head>
<body>

<h2>Login foro uca</h2>

<form action="/signup.php" method="post">
  <div class="fotouca">
    <img src="logo_uca.png" alt="logo" class="logo">
  </div>

  <div class="container">
    <label for="Legajo"><b>Usuario</b></label>
    <input type="text" placeholder="Ingresar Legajo" name="user" class="rojo" id="user" required>

    <label for="contrasenia"><b>Contraseña</b></label>
    <input type="password" placeholder="Ingresar contra" name="pass" class="rojo" id="contra" required>
        
    <button disabled="true" id="boton" type="submit">Ingresar</button>
  </div>
  

</form>

<script type="text/javascript" src="login.js">
</script>


</body>
</html>
