<html xmlns="http://www.w3.org/1999/xhtml"  lang="fr">
<head>

<link type="text/css" href="css/ui.slider.css" rel="stylesheet" />
<link type="text/css" href="css/ui.all.css" rel="stylesheet" />
<link type="text/css" href="css/coinche.css" rel="stylesheet" />

</head>

<body>
	<div id='top' >
		<div id='info'>			
			<div id="buttonsLeft">
				<button id="buttonNew" class="grosButton">Nouvelle partie</button>	
				<button id="buttonRestart" class="grosButton">Reprendre</button>
				<button id="buttonHisto" class="grosButton">Histo</button>
			</div>
			<div id="score">
				<table >
					<tr>
						<td><input type="text" id="score1" class="big" readonly="readonly" value="0" ></input></td>
						<td><input type="text" id="ecart" class="small" readonly="readonly" value="0" ></input></td>
						<td><input type="text" id="score2" class="big" readonly="readonly" value="0" ></input></td>
						<td>
							<div id="clock" ></div><button id="buttonPausePipi" style="border:0;background-color:transparent" title="pause pipi"><img  id="buttonPausePipiImg" src="img/pause.png" width="16"  /></button>
						</td>
					</tr>
				</table>
			</div>					
			<div id="buttonsRight">
				<button id="buttonFin" class="grosButton">Fin de la partie</button>
			</div>				
		</div>
	</div>
	
	<div id='allContainer'>
		<div id="middle"><!--middle wrapper-->
			<div id="scorechart" class="greyRound" ></div>
			<div id="stats" class="greyRound" >
				<span>STATS</span><br/>
				<div style="height:80px">
				<table cellspacing="10" height="40" width="100%" >					
					<tr>
						<td class="borderBleu">
							<table cellspacing="0" height="100%" width="100%" >					
								<tr>
									<td>Efficacit&eacute;</td>
									<td><input id="eff1" type="text" value="0" ></input>&nbsp;%</td>
								</tr>
								<tr>
									<td>R&eacute;ussite</td>
									<td><input id="reu1" type="text" value="0" ></input>&nbsp;%</td>																
								</tr>
							</table>							
						</td>
						<td class="borderRouge">
							<table cellspacing="0" height="100%" width="100%" >					
								<tr>
									<td>Efficacit&eacute;</td>
									<td><input id="eff2" type="text" value="0" ></input>&nbsp;%</td>
								</tr>
								<tr>
									<td>R&eacute;ussite</td>
									<td><input id="reu2" type="text" value="0" ></input>&nbsp;%</td>																
								</tr>
							</table>							
						</td>				
					</tr>
				</table>
				</div>				
				<div id="statschart"></div>
				<!--
				<table cellspacing="10" height="280" width="100%" >
					<tr height="20">
						<td>Les bleus</td>
						<td align="right">Les rouges</td>
					</tr>
					<tr>
						<td class="borderBleu">
							Efficacit&eacute;<input type="text" value="0" ></input>&nbsp;%<br>
							R&eacute;ussite<input type="text" value="0" ></input>&nbsp;%
							<div id="stats1chart" style="padding:20 0 0 30" ></div>
						</td>
						<td class="borderRouge">
							Efficacit&eacute;<input type="text" value="0" ></input>&nbsp;%<br>
							R&eacute;ussite<input type="text" value="0" ></input>&nbsp;%
							<div id="stats2chart" style="padding:20 0 0 30" ></div>
						</td>				
					</tr>
				</table>
				-->
			</div>			
		</div>
		<div id="bottom"><!--bottom wrapper-->
			<div id="caquiWrap" class="greyRound">
				<span>C'EST A QUI?</span><br/>
				<div id="caqui"></div>
			</div>
			<div id="annonce" class="greyRound" >
				<span>ANNONCES</span><br/>
				<div style="text-align: center;margin:10px">			
					<button id="buttonC" class="button">Coinch&eacute; !</button>&nbsp;&nbsp;
					<button id="buttonSC" class="button">Sur coinch&eacute; !!!</button>
				</div>
				<table id="annonceTable" width="300" >
				  <tr>
					<td>400</td>				  
					<td>250</td>
					<td>205</td>
				  </tr>
				  <tr>
					<td>258</td>				  
					<td>160</td>
					<td>130</td>
				  </tr>
				  <tr>
					<td>242</td>				  
					<td>150</td>
					<td>122</td>
				  </tr>
				  <tr>
					<td>226</td>				  
					<td>140</td>
					<td>114</td>
				  </tr>
				  <tr>
					<td>210</td>				  
					<td>130</td>
					<td>106</td>
				  </tr>
				  <tr>
					<td>194</td>				  
					<td>120</td>
					<td>98</td>
				  </tr>
				  <tr>
					<td>178</td>				  
					<td>110</td>
					<td>90</td>
				  </tr>
				  <tr>
					<td>162</td>				  
					<td>100</td>
					<td>82</td>
				  </tr>
				  <tr>
					<td>146</td>				  
					<td>90</td>
					<td>74</td>
				  </tr>
				  <tr>
					<td>130</td>				  
					<td>80</td>
					<td>65</td>
				  </tr>
				</table>	
			</div>
			
			<div id="point" class="greyRound" >
				<span>POINTS</span><br/>
				<div id="pointBleu" class="borderBleu">
					<div id="pointsSliderBox">
						<div id="slider1" ></div>
					</div>
					<div id="pointsBox">
						<div id="beloteBox1" class="beloteBox">
							belotes: <button id="bel11" class="button belote1">1</button>
							<button id="bel12" class="button belote1">2</button>
							<button id="bel13" class="button belote1">3</button>
							<button id="bel14" class="button belote1">4</button>&nbsp;&nbsp;<span class="plus">+</span>&nbsp;&nbsp;
						</div>
						<input type="text" id="brut1" value="0" ></input>
					</div>
					<div id="pointsBox">
						<!--<button id="buttonCapot1" class="button" >Capot</button>
						<button id="buttonDedans1" class="button" >Dedans</button>-->
						<input type="text" id="total1" value="0" ></input>
					</div>
				</div>	
				<div id="pointRouge" class="borderRouge">
					<div id="pointsSliderBox">
						<div id="slider2" ></div>
					</div>	
					<div id="pointsBox">
						<div id="beloteBox2" class="beloteBox">
							belotes: <button id="bel21" class="button belote2">1</button>
							<button id="bel22" class="button belote2">2</button>
							<button id="bel23" class="button belote2">3</button>
							<button id="bel24" class="button belote2">4</button>&nbsp;&nbsp;<span class="plus">+</span>&nbsp;&nbsp;						
						</div>				
						<input type="text" id="brut2" value="0" ></input>
					</div>		
					<div id="pointsBox">
						<!--<button id="buttonCapot2" class="button" >Capot</button>
						<button id="buttonDedans2" class="button" >Dedans</button>-->
						<input type="text" id="total2" value="0" ></input>
					</div>	
				</div>
				<div id="pointsButton">						
					<button id="buttonUndo" class="grosButton">Undo</button>
					<button id="buttonOK" class="grosButton">OK</button>
				</div>		
				
			</div>
		</div><!--end wrapper-->
	</div>
	<div id="confirmDialog" style="display: none;"><p><img src="img/undo.png" align="middle" style="margin:0 10"></img>Annuler la derni&egrave;re donne ?</p></div>
	<div id="finDialog" style="display: none;"><p><img src="img/stop.png" align="middle" style="margin:0 10"></img>Fin de la partie ?</p></div>
	<div id="histoDialog" style="display: none;"></div>
	<div id="errorDialog" style="display: none;"></div>
	<div id="newPartieDialog" style="display: none;">		
			<div id='equipe1' class='equipe'>
				<span>Les bleus</span><br><br>
				Joueur 1<select id="j11">
					<option value="1">Fredo</option>
					<option value="2">Marco</option>
					<option value="3">Nico</option>
					<option value="4">Olivier</option>
				</select><br>
				Joueur 2<select id="j12">
					<option value="1">Fredo</option>
					<option value="2">Marco</option>
					<option value="3">Nico</option>
					<option value="4">Olivier</option>
				</select>				
			</div>
			<div id='equipe2' class='equipe'>
				<span>Les rouges</span><br><br>
				Joueur 1<select id="j21">
					<option value="1">Fredo</option>
					<option value="2">Marco</option>
					<option value="3">Nico</option>
					<option value="4">Olivier</option>
				</select><br>
				Joueur 2<select id="j22">
					<option value="1">Fredo</option>
					<option value="2">Marco</option>
					<option value="3">Nico</option>
					<option value="4">Olivier</option>
				</select>				
			</div>						
	</div>
</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js" type="text/javascript"></script>
<script src="js/FusionCharts.js" type="text/javascript"></script>
<script src="js/highcharts.js" type="text/javascript"></script>
<script src="js/excanvas.compiled.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.countdown.min.js"></script>
<script type="text/javascript" src="js/ui.core.js"></script>
<script type="text/javascript" src="js/ui.slider.js"></script>
<script type="text/javascript" src="js/ui.dialog.js"></script>
<script type="text/javascript" src="js/coinche.js"></script>

</html>
