function publicar_comentario()
{
    let mensaje = document.getElementById("id_message_body").value;
    let autor = $("#typing-area").data("id-usuario");
    let producto = $("#typing-area").data("id-producto");
    if(autor === -1 || producto === -1)
    {
        alert("Error inesperado. Producto y usuario no válidos.")
        return false;
    }
    let xhr = new XMLHttpRequest();
    const message = 
    {
        autor: autor,
        mensaje: mensaje,
        producto: producto
    };
    xhr.open("POST", "./controller/comment.php", false);
    xhr.onreadystatechange = function () 
    {
        try
        {
            if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
            {
                let res = JSON.parse(xhr.response);
                if(res.success != true)
                {
                    console.log(xhr.response);
                    authResult = false;
                }
                authResult = true;
            }
        }catch(error)
        {
            console.log("Ha ocurrido un error.");
            console.error(xhr.response);
            console.log(error);
        }
    }
    xhr.send(JSON.stringify(message));
    alert("ERR");
    return authResult;
}