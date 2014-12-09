	<?php
					$conn = mysql_connect("localhost", "hobjetos_dev", "br309090") or die ("Servidor não responde");
					$db = mysql_select_db("hobjetos_db") or die ("Não foi possível realizar a conexão com o Banco de Dados");
					$id_produto = base64_decode($_GET['id']);
	if($id_produto == null){
		include 'http://www.hobjetos.com.br/scripts/404.html';
	}else{
		$sql = mysql_query("SELECT * FROM produtos INNER JOIN categorias ON categorias.id = produtos.id_categoria INNER JOIN marcas ON marcas.id = produtos.id_marca WHERE produtos.id  = '$id_produto' LIMIT 1") or die(mysql_error());			
		$sql2 = mysql_query("SELECT * FROM produtos INNER JOIN categorias ON categorias.id = produtos.id_categoria INNER JOIN marcas ON marcas.id = produtos.id_marca WHERE produtos.id  = '$id_produto' LIMIT 1") or die(mysql_error());
		$sql3 = mysql_query("SELECT * FROM produtos WHERE produtos.id  = '$id_produto' LIMIT 1") or die(mysql_error());	
		if(mysql_num_rows($sql) < 1)
		{
			include 'http://www.hobjetos.com.br/scripts/404.html';
		}
		else
		{
			while($sql4 = mysql_fetch_array($sql3)){
	 $visitas = $sql4['acessos'];
	 }
	 $add_visitas = $visitas + 1;
	 $add = mysql_query("UPDATE produtos SET acessos = '$add_visitas' WHERE produtos.id  = '$id_produto'") or die('Erro ai inserir cliques');
					?>
                    
                    <!DOCTYPE html>
<!--
    Copyright (c) 2012-2014 Adobe Systems Incorporated. All rights reserved.

    Licensed to the Apache Software Foundation (ASF) under one
    or more contributor license agreements.  See the NOTICE file
    distributed with this work for additional information
    regarding copyright ownership.  The ASF licenses this file
    to you under the Apache License, Version 2.0 (the
    "License"); you may not use this file except in compliance
    with the License.  You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

    Unless required by applicable law or agreed to in writing,
    software distributed under the License is distributed on an
    "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
     KIND, either express or implied.  See the License for the
    specific language governing permissions and limitations
    under the License.
-->
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="format-detection" content="telephone=no" />
        <meta name="msapplication-tap-highlight" content="no" />
        <!-- WARNING: for iOS 7, remove the width=device-width and height=device-height attributes. See https://issues.apache.org/jira/browse/CB-4323 -->
        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
        <link rel="stylesheet" type="text/css" href="css/css.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="css/hobjetos_style01.css" />        
        <title>Hobjetos App</title>
        <script type="text/javascript" src="js/jquery-1.11.1.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <?php
while($rety = mysql_fetch_array($sql2)){
	
	?>
    <!--Facebook-->
<meta property="og:image" content="http://hobjetos.com.br/images/uploads/produtos_p/<?php echo $rety[7]?>" />
<meta property="og:title" content="<?php echo $rety[1]?>"/>
<meta property="og:site_name" content="http://www.hobjetos.com.br/produto.php?id=<?php echo base64_encode($rety[0])?>'"/>
<meta property="og:description" content="<?php echo $rety[1]?> - Categoria: <?php echo $rety[10]?> - Marca:<?php echo $rety[12]?> | <?php echo $titulo_site?>"/>
<?php 
	}
?>
        
        <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!--Google + -->
<script type="text/javascript">
  window.___gcfg = {lang: 'pt-BR'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
        
                <script type="text/javascript">
			$(document).ready(function(){
	$('.menu-anchor').on('click touchstart', function(e){
		$('html').toggleClass('menu-active');
	  	e.preventDefault();
	});
	
			});
        </script>
    </head>
    <body onLoad="mostra()">
        <div class="app">

<header>
	<span class="menu-anchor"></span>
  <h1>Hobjetos App</h1>
</header>

<menu>
	<ul>
		<li><a onclick="window.history.back(-1)">Voltar</a></li>
		
	</ul>
</menu>

<section class="main">
<div class="pag">
    <!-- Sessão Produto Meio2 -->
    <section id="Produto_meio2">
    
    <div id="produto">
    	<!-- Indice da pagina produto -->
    	<div id="prod_topo2">
        	
            <div id="logo_prod2">
            	<img src="http://www.hobjetos.com.br/images/site/logomarca_produto_hobjetos_perfumaria_e_acessorios.jpg" width="321" height="88" border="0" alt="<?php echo $titulo_site?> - Produto" />
                 <?php
						while($retorno = mysql_fetch_array($sql)){
					?>
                <h2>Mostrando: <?php echo utf8_encode($retorno[1])?></h2>
            </div>
           </div><!--  FIM PROD_TOPO2 -->
           
           <!-- Pooduto mostrar -->
    	<div id="prod_mostrar">       
          	<img class="produto_img" src="http://www.hobjetos.com.br/images/uploads/produtos_g/<?php echo $retorno[7]?>" width="284" height="252" border="0" alt="<?php echo utf8_encode($retorno[1])?>" />
                
                <h2 class="um"><?php echo utf8_encode($retorno[1])?></h2>
                <br>
                <h2 class="dois"><?php echo utf8_encode($retorno[10])?></h2>
                <br>
                <h2 class="dois"><?php echo utf8_encode($retorno[12])?></h2>
                
                <div id="likes">
                <div class="g-plusone" data-size="medium" data-href="http://www.hobjetos.com.br/produto.php?id=<?php echo base64_encode($retorno[0])?>'"></div>                
                 <a href="http://twitter.com/share" class="twitter-share-button" data-url="https://www.hobjetos.com.br/produto.php?id=<?php echo base64_encode($retorno[0])?>'" data-lang="pt" data-hashtags="styltype">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<div class="fb-like" data-href="http://www.hobjetos.com.br/produto.php?id=<?php echo base64_encode($retorno[0])?>'" data-width="200" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
        
        </div>
                </div>
                <?php
						}
		}
		
	}
						?>
          
         </div><!--  FIM PRODUTO -->
            
            
         
    
    
    </section>
      
          
      </div>
</section>
        
    </body>
</html>
