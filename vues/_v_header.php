<!DOCTYPE html>
<html>
    <head>
        <title>BMG - Municipale de Groville</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="styles/screen.css" />
        <script
            type="text/javascript"
            src="https://code.jquery.com/jquery-3.5.1.js"
            integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
            crossorigin="anonymous">
        </script>
    </head>
    <style>

    </style>
    <body>       
        <header id="main-header">
            <hr />
            <div>
                <span class="titre-entete">
                    Bibliothèque municipale de Groville
                </span>
            </div>
            <hr />
            <div id="infos-util">
                <?php echo 'Connecté : '
                    .$_SESSION['prenom']." "
                    .$_SESSION['nom'];
                ?>
            </div>  

       
           
        </header>
        
        