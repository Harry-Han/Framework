<?
if(isset($_GET['parentId'])){
	switch($_GET['parentId']){
		case "1":
			?>
			<li><a href="#">Denmark</a>
				<ul>
					<li parentId="12"><a href="#">Loading</a></li>
				</ul>
			</li>
			<li><a href="#">Norway</a>
				<ul>
					<li parentId="11"><a href="#">Loading</a></li>
				</ul>
			</li>
			<li><a href="#">Sweden</a></li>
			<li><a href="#">Germany</a></li>
			<li><a href="#">France</a></li>
			<li><a href="#">Spain</a>
				<ul>
					<li parentId="14"><a href="#">Loading</a></li>
				</ul>
			</li>
			<li><a href="#">Italy</a>
				<ul>
					<li parentId="13"><a href="#">Loading</a></li>
				</ul>
			</li>
			<?
			break;
		case "11":
			?>
			<li class="dhtmlgoodies_sheet.gif"><a href="#">Bergen</a></li>
			<li class="dhtmlgoodies_sheet.gif"><a href="#">Stavanger</a></li>
			<li class="dhtmlgoodies_sheet.gif"><a href="#">Trondheim</a></li>
			<li class="dhtmlgoodies_sheet.gif"><a href="#">Oslo</a></li>
			<?
			break;
		case "12":
			?>
			<li class="dhtmlgoodies_sheet.gif"><a href="#">Copenhagen</a></li>
			<li class="dhtmlgoodies_sheet.gif"><a href="#">Aalborg</a></li>
			<?
			break;
		case "13":
			?>
			<li class="dhtmlgoodies_sheet.gif"><a href="#">Rome</a></li>
			<li class="dhtmlgoodies_sheet.gif"><a href="#">Venice</a></li>
			<li class="dhtmlgoodies_sheet.gif"><a href="#">Palermo</a></li>
			<li class="dhtmlgoodies_sheet.gif"><a href="#">Napoli</a></li>
			<?
			break;
		case "14":
			?>
			<li class="dhtmlgoodies_sheet.gif"><a href="#">Madrid</a></li>
			<li class="dhtmlgoodies_sheet.gif"><a href="#">Barcelona</a></li>
			<?
			break;
		case "2":
			?>
			<li><a href="#">China</a></li>
			<li><a href="#">Japan</a></li>
			<?
			break;
		case "3":
			?>
			<li><a href="#">Nigeria</a></li>
			<li><a href="#">South Africa</a></li>
			<li><a href="#">Senegal</a></li>
			<?
			break;
		case "4":
			?>
			<li><a href="#">Canada</a>
				<ul>
					<li parentId="41"><a href="#">Loading</a></li>
				</ul>
			</li>
			<li><a href="#">United States</a>
				<ul>
					<li parentId="42"><a href="#">Loading</a></li>
				</ul>
			</li>
			<li><a href="#">Mexico</a></li>
			<li><a href="#">Argentina</a></li>
			<li><a href="#">Chile</a></li>
			<li><a href="#">Brazil</a></li>
			<li><a href="#">Bolivia</a></li>
			<li><a href="#">Peru</a></li>
			<?
			break;
		case "42":
			?>
			<li class="dhtmlgoodies_sheet.gif"><a href="#">Washington</a></li>
			<li class="dhtmlgoodies_sheet.gif"><a href="#">Chicago</a></li>
			<li class="dhtmlgoodies_sheet.gif"><a href="#">Boston</a></li>
			<?
			break;
		case "41":
			?>
			<li class="dhtmlgoodies_sheet.gif"><a href="#">Toronto</a></li>
			<?
			break;
	}
}
?>