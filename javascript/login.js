function authLogin()
{
    
    const cUsername = document.getElementById("username");
    const cPassword = document.getElementById("password");
    var authResult = false;
    let xhr = new XMLHttpRequest();
    const user = 
    {
        username: cUsername.value.trim(),
        password: cPassword.value.trim()
    };
    xhr.open("POST", "./controller/login.php", true);
    xhr.onreadystatechange = function () 
    {
        try
        {
            if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
            {
                console.log(xhr.response);
                let res = JSON.parse(xhr.response);
                if(res.success != true)
                {
                    authResult = false;
                    document.getElementById('id_login_validation').hidden = false;
                    return false;
                }
                window.location.replace("./index.html");
                authResult = true;
            }
        }catch(error)
        {
            console.error(xhr.response);
        }
    }
    xhr.send(JSON.stringify(user));
    return authResult;
}