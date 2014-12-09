 <!-- Sessão Meio Left -->
    <section id="meio_left">
    	
        <div id="destaque">
        	
            <div id="menu_left">
            	<p style="background:#A864AB; padding:6px; color:#FFF" class="titulos">Produtos de Destaque <span class="icone posa"></span></p>
            </div>
            
            <div id="produtos_destaque">
            <!-- Mostra os Ultimos produtos cadastrados-->
            	<ul id="prod_destaque">
                	<?php
					$conn = mysql_connect("localhost", "hobjetos_dev", "br309090") or die ("Servidor não responde");
					$db = mysql_select_db("hobjetos_db") or die ("Não foi possível realizar a conexão com o Banco de Dados");
	
						$sql = mysql_query("SELECT * FROM produtos ORDER BY id LIMIT 10") or die(mysql_error());
						while($retorno = mysql_fetch_array($sql)){
							
					?>
                	<li onClick="window.location.href='http://www.hobjetos.com.br/produtoapp.php?t=<?php echo md5(time())?>&id=<?php echo base64_encode($retorno[0])?>'" title="<?php echo utf8_encode($retorno[1])?>" class="produto"><img src="http://hobjetos.com.br/images/uploads/produtos_p/<?php echo $retorno[7]?>" width="156" height="116" border="0" alt="<?php echo utf8_encode($retorno[1])?>" /><p>
					<?php if(strlen(utf8_encode($retorno[1])) <= 34){
						echo utf8_encode($retorno[1]);
					}else{
						echo trim(substr(utf8_encode($retorno[1]), 0, 34))."...";
					}?></p>
                    </li>                    
                    <?php
						}flush();
						?>
                </ul>               
            </div>
            
            
        </div>
        
       
    
    
    
    </section>