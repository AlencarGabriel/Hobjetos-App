	<?php
					$conn = mysql_connect("localhost", "hobjetos_dev", "br309090") or die ("Servidor não responde");
					$db = mysql_select_db("hobjetos_db") or die ("Não foi possível realizar a conexão com o Banco de Dados");
						
	$marca = $_GET['ma'];
	$pag = $_GET['pag'];
	$cat = $_GET['cat'];
	$s1 = mysql_query("SELECT MAX( acessos )FROM produtos");
	$cont = mysql_query("SELECT * FROM produtos");
	while($conta = mysql_fetch_array($s1))
	{
		$valor = $conta[0];
		$maior = $valor /$cont;
	}
	$query = $_GET ['qr'];
	
	if(!isset($cat))
	{
		$acr[0] = "";
	}else{
		if($cat != "Todos" && $cat != "")
		{
			$s2 = mysql_query("SELECT id, nome FROM categorias WHERE id = $cat limit 1");
			while($result_cat = mysql_fetch_array($s2))
			{
				$legendac = $result_cat[1];
			}
			$acr[1] = "AND id_categoria = '$cat'";
			$acr[2] = "WHERE id_categoria = '$cat'";
		}
	}
	
	if($marca == "")
	{
		switch($query)
		{
			case 1:
				$listar = "SELECT * FROM produtos WHERE acessos >= $maior $acr[1] ORDER BY id DESC";
				$legenda[0] = "Produtos Mais Vistos";
				break;
			
			case 2:
				$listar = "SELECT * FROM produtos WHERE acessos < $maior $acr[1] ORDER BY id DESC";
				$legenda[0] = "Produtos Menos Vistos";
				break;
				
			case 3:
				$listar = "SELECT * FROM produtos $acr[2] ORDER BY nome ASC";
				$legenda[0] = "Produtos em Ordem Alfabética";
				break;
				
			default:
				$listar = "SELECT * FROM produtos $acr[2] ";
				if($cat == ""){$legenda[0] = "Todos os Produtos";}else if($cat == "Todos"){$listar = "SELECT * FROM produtos";$legenda[0] = "Todos os Produtos";}else{$legenda[0] = $legendac;}			
				break;
		}
	}
	else
	{
		$ss = mysql_query("SELECT id, nome FROM marcas WHERE id = $marca limit 1");
			while($result_cats = mysql_fetch_array($ss))
			{
				$listar = "SELECT * FROM produtos WHERE id_marca = '$marca' ORDER BY nome ASC";
				$legenda[0] = $result_cats[1];	
			}
				
	}
	$links = '10'; //QUANTIDADE DE LINKS NO PAGINATOR
	if($pag > $links)
	{
		include 'http://www.hobjetos.com.br/scripts/404.html';
	}
	else
	{
	
if($pag >= '1'){
$pag = $pag;
}else{
$pag = '1';
}

if(!isset($num)){
 	$maximo = '10'; //RESULTADOS POR PGINA
}else{
 	$maximo = $num;
}

$inicio = ($pag * $maximo) - $maximo;
							
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
        <link rel="stylesheet" type="text/css" href="css/hobjetos_style02.css" />
        <title>Hobjetos App</title>
        <script type="text/javascript" src="js/jquery-1.11.1.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        
                <script type="text/javascript">
			$(document).ready(function(){
	$('.menu-anchor').on('click touchstart', function(e){
		$('html').toggleClass('menu-active');
	  	e.preventDefault();
	});
	
			});
        </script>
    </head>
    <body>
        <div class="app">

<header>
	<span class="menu-anchor"></span>
  <h1>Hobjetos App</h1>
</header>

<menu>
	<ul>
		<li><a href="index.html">Home</a></li>
		<li><a href="#">Produtos</a></li>
		<li><a href="contato.html">Contato</a></li>
	</ul>
</menu>

<section class="main">
    <!-- Sessão Produto Meio -->
    <section id="Produto_meio">
    
    	<!-- Indice da pagina produtos -->
    	<div id="prod_topo">
        	
            <div id="logo_prod">
            	<img src="http://www.hobjetos.com.br/images/site/logomarca_produtos_hobjetos_perfumaria_e_acessorios.jpg" width="321" height="88" border="0" alt="<?php echo $titulo_site?> - Produtos" />
                
                <h2>Mostrando: <?php echo $legenda[0]?></h2>
            </div>
            
            <!-- Checkbox de opções -->
            <div id="menuc">
            <div class="menus_prod">
            	<!-- Lista as Categorias cadastradas -->
                <form action="" method="get" style="display:inline-block; width:100%;">
            	<select onChange="this.form.submit()" name="cat" class="checkbox1" id="cat">
                <option>Selecione a Categoria</option>
                <option value="Todos">Todos os Produtos</option>
                <?php
					$rs = mysql_query("SELECT * FROM categorias ORDER BY nome");
					while($reg = mysql_fetch_object($rs)){
					?>
                    
              		<option value="<?php echo $reg->id?>"><?php echo utf8_encode($reg->nome)?></option> 
            	<?php
						}
					?>
                </select>
                </form>
                </div>
                <div class="menus_prod">
                 <!--Lista as Categorias cadastradas -->
                 <form action="" method="get" style="display:inline-block; width:100%;">
            	<select onChange="this.form.submit()" class="checkbox1" name="qr" id="opcoes">
                    <option>Exibir produtos</option>
              		<option value="1">Mais Vizualizados</option> 
                    <option value="2">Menos Vizualizados</option> 
                    <option value="3">Ordem Alfabética</option> 
            	
                </select>
                </form>
            </div>   
            </div>
                 
        </div><!-- Indice da pagina produtos -->
        
        <!-- Listar Produtos -->
      <div id="listar_prod">
      
      <!-- Mostra os produtos cadastrados-->
            	<ul id="prod_destaque">
                	<?php
						$sql = mysql_query("$listar LIMIT $inicio,$maximo") or die(mysql_error());
						$unidade = mysql_num_rows($sql);
						if($unidade == 0)
						{
							echo "<b>Nenhum Registro encontrado para essa Busca!</b><br><br>";
						}
						else{
						while($retorno = mysql_fetch_array($sql)){
							
					?>
                	<li onClick="window.location.href='produto.php?t=<?php echo md5(time())?>&id=<?php echo base64_encode($retorno[0])?>'" title="<?php echo utf8_encode($retorno[1])?>" class="produto"><img src="http://www.hobjetos.com.br/images/uploads/produtos_g/<?php echo $retorno[7]?>" width="208" height="154" border="0" alt="<?php echo utf8_encode($retorno[1])?>" /><p>
					<?php if(strlen(utf8_encode($retorno[1])) <= 34){
						echo utf8_encode($retorno[1]);
					}else{
						echo trim(substr(utf8_encode($retorno[1]), 0, 34))."...";
					}?></p>
                    </li>                    
                    <?php
						}						
						?>
                </ul>
        	
      </div>
        
      <!-- Paginator -->
      <div id="paginator_prod">
      
      	<div id="paginator">
      	<b style="color:#111111; margin-top:8px;">Páginas:</b>                           
              <?php
//USE A MESMA SQL QUE QUE USOU PARA RECUPERAR OS RESULTADOS
//SE TIVER A PROPRIEDADE WHERE USE A MESMA TAMBM
$sql_res = mysql_query("$listar");
$total = mysql_num_rows($sql_res);
$paginas = ceil($total/$maximo);

//echo "<li class=\"active\"><a href=\"?pag=1&qr=$query$cat=$cat\">Primeira Página</a></li>&nbsp;&nbsp;&nbsp;";
for ($i = $pag-$links; $i <= $pag-1; $i++){
if ($i <= 0){
}else{
echo"<a href=\"?pag=$i&qr=$query&cat=$cat&ma=$marca\">$i</a>&nbsp;";
}
}echo "<a class=\"disabled\" href=\"\">$pag</a>&nbsp;";
for($i = $pag +1; $i <= $pag+$links; $i++){
if($i > $paginas){
}else{
echo "<a href=\"?pag=$i&qr=$query&cat=$cat&ma=$marca\">$i</a>&nbsp;";
}
}
//echo "<li class=\"active\"><a href=\"?pag=$paginas&qr=$query$cat=$cat\">Última página</a></li>&nbsp;&nbsp;&nbsp;";
						
						}// caso erro de busca == 0
	}
?>
	</div>
              
      </div>
        
        
    
    
    </section>
        </section>
    </body>
</html>