<?php if (isset($error)): ?>
    <div style="color: red; border: 1px solid red; padding: 10px; margin: 10px 0; background-color: #ffe6e6;">
        <strong>Error:</strong> <?php 
        if(!is_array($error)){
            echo htmlspecialchars($error);
        }else{
            var_dump($error);
        }
       ?>
    </div>
<?php endif; ?>

<a href="javascript:history.back()">Go Back</a>
