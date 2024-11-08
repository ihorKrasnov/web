<html>   
<head></head>   
<body>
    <form method="GET" action="index.php">
        <input type="text" name="search" placeholder="Search for a book or author..."
            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <input type="submit" value="Search">
    </form>
    
    <table>   
        <tbody>
            <tr>
                <td>Title</td>
                <td>Author</td>
                <td>Description</td>
            </tr>
        </tbody>   
        <?php    
   
            foreach ($books as $title => $book)   
            {   
                echo '
                <tr>
                    <td>
                        <a href="index.php?book='.$book->title.'">'.$book->title.'</a>
                    </td>
                    <td>
                        '.$book->author.'
                    </td>
                    <td>
                        '.$book->description.'
                    </td>
                </tr>';   
            }   
        ?>   
    </table>   
</body>   
</html>  