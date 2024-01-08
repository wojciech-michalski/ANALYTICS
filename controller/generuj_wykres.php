<?php
		//Funkcja generująca wykres



		?>
<script type="text/javascript">
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer",
	{
//            exportEnabled: true,
//  zoomEnabled: true,
//  toolbar: {
 //   itemBackgroundColor: "white", //Change it to "red"
 //   itemBackgroundColorOnHover: "#3e3e3e",
 //   fontColor: "black",
  //  fontColorOnHover: "white",
 //   buttonBorderColor: "#3e3e3e"
 // },
		colorSet: "colorSet2",
		title:{
			    fontWeight: "bolder",
        fontColor: "#008B8B",
        fontFamily: "tahoma",        
        fontSize: 25,
        padding: 10,       
       			<?php
			
			echo "text: \" $temat\" \n";
			?>
		},
                animationEnabled: true,
               
		legend:{
			verticalAlign: "bottom",
			horizontalAlign: "center"
		},
		data: [
		{        
			indexLabelFontSize: 13,
			indexLabelFontFamily: "Monospace",       
			indexLabelFontColor: "darkgrey", 
			indexLabelLineColor: "darkgrey",        
			indexLabelPlacement: "outside",
			type: "pie",       
			showInLegend: true,
			toolTipContent: "{y} - <strong>#percent%</strong>",
			dataPoints: [
			<?php
			// $ilosci - to wartości do wykresu
			// $kolumny_do_wykresu to kategorie
			$licznik_kawalkow=0;
			foreach ($nextquerycolumns as &$kawalki){
								echo "{  y: $ilosci[$licznik_kawalkow],exploded: true, legendText:\"$kawalki\", indexLabel: \"$kawalki\" },\n";
				$licznik_kawalkow=$licznik_kawalkow+1;
				}
			
			?>
					
			]
		}
		]
	});
	chart.render();
}

</script>
