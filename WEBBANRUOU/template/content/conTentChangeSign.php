<div id="container">
    <div id="contentleft">
    </div>
    <div id="contentcenter">  
        <?php

            include("./template/content/signup.php");  
        ?>
    </div>
    <div id="contentright">
    </div>
</div>
<style>
    #main #container{
    display: flex;
} 
#main #container #contentleft{
    float: left;
    height: 100vh;;
    width: 0%;

}
#main #container #contentcenter{
    float:left;
    min-height: 100vh;
    width: 100%;  
}
#main #container #contentright {
    float:right;
    height: 100vh;
    width: 0%;
}
</style>