<?php   
?>

<!DOCTYPE html>
<html>
<head>
        <title>Testing login api</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript">
                function clearres() {
                        $('#res').val('');
                }

                function displayres(data) {
                        console.log(data);

                        $('#res').val(  $('#res').val()                 + "\n" +
                                        "New response"                  + "\n" +
                                        "Body:"                         + "\n" +
                                        data.responseJSON.body          + "\n" +
                                        "server session:"               + "\n" +
                                        data.responseJSON.session       + "\n" +
                                        "local session:"                + "\n" +
                                        data.responseJSON.jssession     + "\n" +
                                        "test:"                         + "\n" +
                                        data.responseJSON.test          + "\n" );
                }

                function setadmin() {
                        $('#email').val('admin@fake.com');
                        $('#pass').val('');
                }

                function setuser() {
                        $('#email').val('user@fake.com');
                        $('#pass').val('');
                }

                function login() {
                        var email       = $('#email').val();
                        var pass        = $('#pass').val();

                        $.ajax({
                                url: "http://localhost/logintest2/index.php",
                                method: 'POST',
                                data: {
                                        email:email,
                                        pass:pass

                                },
                                headers: {
                                        q:'login'
                                },
                                complete: function(data) {
                                        displayres(data);
                                        $('#session').val(data.responseJSON.session);
                                },
                                xhrFields: {
                                        withCredentials: true
                                }
                        })   
                }

                function logout() {
                        var session     = $('#session').val();

                        $.ajax({
                                url: "http://localhost/logintest2/index.php",
                                method: 'POST',
                                headers: {
                                        q:'logout',
                                        session:session
                                },
                                complete: function(data) {
                                        displayres(data);
                                },
                                xhrFields: {
                                        withCredentials: true
                                }
                        })   
                }

                function getstuff() {
                        var session     = $('#session').val();
                        var name        = $('#name').val();
                        var q           = $('#q ').val();

                        $.ajax({
                                url: "http://localhost/logintest2/index.php",
                                method: 'POST',
                                data: {
                                        name:name,
                                        orgtype_id: 1,
                                        org_id: 1

                                },
                                headers: {
                                        session:session,
                                        q:q
                                },
                                complete: function(data) {
                                        displayres(data);
                                }
                        }) 
                }
        </script>
</head>
<body>
        <input type="text" name="email" id="email" placeholder="email" value="admin@fake.com"><input type="password" name="password" id="pass" placeholder="password" value="testAdmin"><br>
        <br>
         <button onclick="login()">login</button><button onclick="logout()">logout</button><button onclick="setadmin()">set admin</button><button onclick="setuser()">set user</button><br>
        <br>
        <input type="text" name="name" id="name"><br>
        <br>
        <input type="text" name="q" id="q"><button onclick="getstuff()">Get stuff</button> <button onclick="clearres()">clear response</button><br>
        <br>
        <textarea id="res" rows="30" cols="80" placeholder="response"></textarea>
        <input type="hidden" name="APIsession" id="session">
</body>
</html>
