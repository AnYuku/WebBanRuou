<div id="container">
    <div id="contentleft">
    </div>
    <div id="contentcenter">  
        <?php
                include("./template/content/login.php"); 
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
    width: 15%;

}
#main #container #contentcenter{
    float:left;
    min-height: 100vh;
    width: 70%;  
}
#main #container #contentright {
    float:right;
    height: 100vh;
    width: 15%;
}
</style>