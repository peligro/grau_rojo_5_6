<?php
    $tamano1=$ing->tamano_a_imprimir_1;
    $tamano2=$ing->tamano_a_imprimir_2;
 
    if($tamano1==60 and $tamano2>100)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1==70 and $tamano2>120)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1==80 and $tamano2>89)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1==90 and $tamano2>89)
    {
        $maquina="Máquina Roland 800";
    }elseif($tamano1>90 and $tamano2>60)
    {
        $maquina="Máquina Roland 800";
    }else
    {
        $maquina="Máquina Roland 800";
    }
    /**	
       * validaciones mermas
       * */
       
       if($fotomecanica->colores>3)
        {
            if($maquina=="Máquina Roland 800")
            {
                if($datos->vb_maquina == 'SI' or $datos->acepta_excedentes == 'NO')
                {
                    $color1=0;
                    $color2= $fotomecanica->colores*150;				
                }else{			
                    $color1=0;
                    $color2= $fotomecanica->colores*100;
                }
            }else
            {
                if($datos->vb_maquina == 'SI' or $datos->acepta_excedentes == 'NO')
                {
                    $color1=0;
                    $color2= $fotomecanica->colores*150;				
                }else{			
                $color1=0;
                $color2= $fotomecanica->colores*100;
                }
            }
        }else
        {
            if($fotomecanica->colores == 0)
            {
              $color1=0;
              $color2=0;
            }elseif($fotomecanica->colores >= 1 and $fotomecanica->colores <= 3)
            {	
              if($maquina=="Máquina Roland 800")
              {
                 $color1= 400;
                 $color2=0;
              }else
              {
                      //ultra
                 $color1= 300;
                 $color2=0;
              }
            }
        }
         
         $canTotal=number_format($datos->cantidad_1/5000,0,"","")-1;//6000 1
         //echo $canTotal;exit;
         if (($datos->cantidad_1>0) and ($ing->unidades_por_pliego>0))
            $cantidad_1=$datos->cantidad_1/$ing->unidades_por_pliego;
         else 
             $cantidad_1=0;
         //echo $cantidad_1;exit;
         if (($datos->cantidad_2>0) and ($ing->unidades_por_pliego>0))
            $cantidad_2=$datos->cantidad_2/$ing->unidades_por_pliego;
         else 
             $cantidad_2=0;
         //echo $cantidad_1;exit;
         if (($datos->cantidad_3>0) and ($ing->unidades_por_pliego>0))
            $cantidad_3=$datos->cantidad_3/$ing->unidades_por_pliego;
         else 
             $cantidad_3=0;
         //echo $cantidad_1;exit;
         if (($datos->cantidad_4>0) and ($ing->unidades_por_pliego>0))
            $cantidad_4=$datos->cantidad_4/$ing->unidades_por_pliego;
         else 
             $cantidad_4=0;
         //echo $ing->unidades_por_pliego;exit;
         
         if($cantidad_1>5000)
         {
            $vecescan1 = ($cantidad_1) / 5000;
            if($vecescan1 >1)
            {
               $can1= 100 * $vecescan1;
            }else{
               $can1=100;
            }
            if($vecescan1 >1)
            {
                //$entero=number_format(($cantidad_1/5000)+0.5,0,'','');
                $can2= 50 * $vecescan1;
            }else
            {
                $can2=50;
            }
         }else
         {
            $can1=0;
            $can2=0;
         }
       //  echo $can1;exit();
        //cantidad para merma 2
         if($cantidad_2>5000)
         {
            $vecescan2 = ($cantidad_2) / 5000;
            if($vecescan2 >1)
            {
               $can3= 100 * $vecescan2;
            }else{
               $can3=100;
            }
            if($vecescan2 >1)
            {
                //$entero=number_format(($cantidad_1/5000)+0.5,0,'','');
                $can4= 50 * $vecescan2;
            }else
            {
                $can4=50;
            }
         }else
         {
            $can3=0;
            $can4=0;
         }
        //cantidad para merma 3
         if($cantidad_3>5000)
         {
            $vecescan3 = ($cantidad_3) / 5000;
            if($vecescan3 >1)
            {
               $can5= 100 * $vecescan3;
            }else{
               $can5=100;
            }
            if($vecescan3 >1)
            {
                //$entero=number_format(($cantidad_1/5000)+0.5,0,'','');
                $can6= 50 * $vecescan3;
            }else
            {
                $can6=50;
            }
         }else
         {
            $can5=0;
            $can6=0;
         }
        //cantidad para merma 4
         if($cantidad_4>5000)
         {
            $vecescan4 = ($cantidad_4) / 5000;
            if($vecescan4 >1)
            {
               $can7= 100 * $vecescan4;
            }else{
               $can7=100;
            }
            if($vecescan4 >1)
            {
                //$entero=number_format(($cantidad_1/5000)+0.5,0,'','');
                $can8= 50 * $vecescan4;
            }else
            {
                $can8=50;
            }
         }else
         {
            $can7=0;
            $can8=0;
         }
        
        
        $barniz=substr($fotomecanica->acabado_impresion_1,0,6);
        //echo $barniz;exit;
         if(($fotomecanica->fot_lleva_barniz!='') && ($fotomecanica->fot_lleva_barniz!='Nada'))
         {
            $cantidadBarniz=$datos->cantidad_1-1000;
            if($cantidadBarniz<1000)
            {
                if($maquina=="Máquina Roland 800")
                {
                    //$bar1=150;
                    $bar1=100;
                    $bar2=0;
                }else
                {
                    $bar1=100;
                    $bar2=0;
                }
            }else
            {
			
               //echo $datos->cantidad_1/$ing->unidades_por_pliego;exit;
               $enteroBarniz=($datos->cantidad_1/$ing->unidades_por_pliego);
		//echo $enteroBarniz;exit();
               if($enteroBarniz < 1000)
			   {
				//$bar1=150;
				$bar1=100;
                $bar2=0;   
			   }else
			   {
               $enteroBarniz=(((number_format($enteroBarniz,0,'','')/1000)+1)-2)*10;
               //echo $enteroBarniz;exit();
               //echo $enteroBarniz;exit;   
               //$bar1=150;
               $bar1=100;
               $bar2=$enteroBarniz;
			   }
            }
            
            
         }else
         {
                $bar1=0;
                $bar2=0;
         }
         
         //calculo dos para barniz de merma
                  if(($fotomecanica->fot_lleva_barniz!='') && ($fotomecanica->fot_lleva_barniz!='Nada'))
         {
            $cantidadBarniz2=$datos->cantidad_2-1000;
            if($cantidadBarniz2<1000)
            {
                if($maquina=="Máquina Roland 800")
                {
                    //$bar1=150;
                    $bar3=100;
                    $bar4=0;
                }else
                {
                    $bar3=100;
                    $bar4=0;
                }
            }else
            {
			
               //echo $datos->cantidad_1/$ing->unidades_por_pliego;exit;
               $enteroBarniz2=($datos->cantidad_2/$ing->unidades_por_pliego);
		//echo $enteroBarniz;exit();
               if($enteroBarniz2 < 1000)
			   {
				//$bar1=150;
				$bar3=100;
                $bar4=0;   
			   }else
			   {
               $enteroBarniz2=(((number_format($enteroBarniz2,0,'','')/1000)+1)-2)*10;
               //echo $enteroBarniz;exit();
               //echo $enteroBarniz;exit;   
               //$bar1=150;
               $bar3=100;
               $bar4=$enteroBarniz2;
			   }
            }
            
            
         }else
         {
                $bar3=0;
                $bar4=0;
         }
         //calculo tres para barniz de merma
                  if(($fotomecanica->fot_lleva_barniz!='') && ($fotomecanica->fot_lleva_barniz!='Nada'))
         {
            $cantidadBarniz3=$datos->cantidad_3-1000;
            if($cantidadBarniz3<1000)
            {
                if($maquina=="Máquina Roland 800")
                {
                    //$bar1=150;
                    $bar5=100;
                    $bar6=0;
                }else
                {
                    $bar5=100;
                    $bar6=0;
                }
            }else
            {
			
               //echo $datos->cantidad_1/$ing->unidades_por_pliego;exit;
               $enteroBarniz3=($datos->cantidad_3/$ing->unidades_por_pliego);
		//echo $enteroBarniz;exit();
               if($enteroBarniz3 < 1000)
			   {
				//$bar1=150;
				$bar5=100;
                                $bar6=0;   
			   }else
			   {
               $enteroBarniz3=(((number_format($enteroBarniz3,0,'','')/1000)+1)-2)*10;
               //echo $enteroBarniz;exit();
               //echo $enteroBarniz;exit;   
               //$bar1=150;
               $bar5=100;
               $bar6=$enteroBarniz3;
			   }
            }
            
            
         }else
         {
                $bar5=0;
                $bar6=0;
         }
         //calculo cuatro para barniz de merma
                  if(($fotomecanica->fot_lleva_barniz!='') && ($fotomecanica->fot_lleva_barniz!='Nada'))
         {
            $cantidadBarniz4=$datos->cantidad_4-1000;
            if($cantidadBarniz4<1000)
            {
                if($maquina=="Máquina Roland 800")
                {
                    //$bar1=150;
                    $bar7=100;
                    $bar8=0;
                }else
                {
                    $bar7=100;
                    $bar8=0;
                }
            }else
            {
			
               //echo $datos->cantidad_1/$ing->unidades_por_pliego;exit;
               $enteroBarniz4=($datos->cantidad_4/$ing->unidades_por_pliego);
		//echo $enteroBarniz;exit();
               if($enteroBarniz4 < 1000)
			   {
				//$bar1=150;
				$bar7=100;
                                $bar8=0;   
			   }else
			   {
               $enteroBarniz4=(((number_format($enteroBarniz4,0,'','')/1000)+1)-2)*10;
               //echo $enteroBarniz;exit();
               //echo $enteroBarniz;exit;   
               //$bar1=150;
               $bar7=100;
               $bar8=$enteroBarniz4;
			   }
            }
            
            
         }else
         {
                $bar7=0;
                $bar8=0;
         }
		 

		
		
		
        if($datos->procesos_especiales_folia=="SI")
        {
            $folia=25;
        }else
        {
            $folia=0;
        }
 
        $acabado_nombre4=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_4);
        $acabado_nombre5=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_5);
        $acabado_nombre6=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_6);
		
		
	if(strstr($acabado_nombre4->caracteristicas,"LACA") != false)
        {
            $laca=25;
        }

	if(strstr($acabado_nombre5->caracteristicas,"LACA") != false)
        {
            $laca=25;
        }
		
	if(strstr($acabado_nombre6->caracteristicas,"LACA") != false)
        {
            $laca=25;
        }
		
        if($laca == null)
        {
                $laca=0;
        }
		
		
	if(strstr($acabado_nombre4->caracteristicas,"TERMOLAMINADO") != false)
        {
            $termolaminado=50;
			
        } 
		
	if(strstr($acabado_nombre5->caracteristicas,"TERMOLAMINADO") != false)
        {
            $termolaminado=50;
			
        }
		
         if(strstr($acabado_nombre6->caracteristicas,"TERMOLAMINADO") != false)
        {
            $termolaminado=50;
			
        }
		
		
		
		if($acabado_nombre4->tipo == 'Externo' and $acabado_nombre4->id != 17)
        {
			//echo $acabado_nombre4->tipo;
            $numeros_de_acabados=1;			
        }else
        {
        } 
		
		if($acabado_nombre5->tipo == 'Externo' and $acabado_nombre5->id != 17)
        {
			//echo $acabado_nombre5->tipo;
            $numeros_de_acabados=2;		
        }else
        {
        } 
		
         if($acabado_nombre6->tipo == 'Externo' and $acabado_nombre6->id != 17)
        {
			//echo $acabado_nombre6->tipo;
            $numeros_de_acabados=3;	
        }else
        {
        } 
		
		 if($numeros_de_acabados >= 2)
        {
            $termolaminado=0;
        }
		
                if($fotomecanica->acabado_impresion_4!="17" or $fotomecanica->acabado_impresion_5!="17" or $fotomecanica->acabado_impresion_6!="17"){
                    
                if($fotomecanica->acabado_impresion_4!="No lleva" or $fotomecanica->acabado_impresion_5!="No lleva" or $fotomecanica->acabado_impresion_6!="No lleva"){
                    
             if($fotomecanica->acabado_impresion_4!="" or $fotomecanica->acabado_impresion_5!="" or $fotomecanica->acabado_impresion_6!=""){
                 
			$externo=50;
                }else{
                    
                        $externo=0;
                }
                }
                }
        
//        echo $externo."<br>";
//        echo $fotomecanica->acabado_impresion_4;
//        echo $fotomecanica->acabado_impresion_5;
//        echo $fotomecanica->acabado_impresion_6;exit();
        //rutina para acabados internos agregado por ehndz
        $var1=0;
        $var2=0;
        $var3=0;
        if (($fotomecanica->acabado_impresion_1!='') && ($fotomecanica->acabado_impresion_1!=16))	
            $var1=1;
	if (($fotomecanica->acabado_impresion_2!='')  && ($fotomecanica->acabado_impresion_2!=16))      
            $var2=1;
	if (($fotomecanica->acabado_impresion_3!='')  && ($fotomecanica->acabado_impresion_3!=16))      
            $var3=1;
        $totalTrabajosInternos=$var1+$var2+$var3; 
        if($totalTrabajosInternos>0){
            $totalTrabajosInternos;
        }else{
            $totalTrabajosInternos="No";
        }
        //fin de rutina para acabados internos agregados por ehndz
        //rutina para acabados internos agregado por ehndz
        $var1=0;
        $var2=0;
        $var3=0;
        if (($fotomecanica->acabado_impresion_4!='') && ($fotomecanica->acabado_impresion_4!=17))	
            $var1=1;
	if (($fotomecanica->acabado_impresion_5!='')  && ($fotomecanica->acabado_impresion_5!=17))      
            $var2=1;
	if (($fotomecanica->acabado_impresion_6!='')  && ($fotomecanica->acabado_impresion_6!=17))      
            $var3=1;
        $totalTrabajosExternos=$var1+$var2+$var3; 
        if($totalTrabajosExternos>0){
            $totalTrabajosExternos;
        }else{
            $totalTrabajosExternos="No";
        }
        //fin de rutina para acabados internos agregados por ehndz
        
		
       // echo $ing->materialidad_datos_tecnicos;exit;
        if($ing->materialidad_datos_tecnicos=="Onda a la Vista")
        {
             $canTotal2=number_format($datos->cantidad_1/1000,0,"","");
          // echo $canTotal2;exit;
            if($canTotal2>=1)
            {
                $micromicro=30*$canTotal2;
            }else
            {
                $micromicro=0;
            }
        }else
        {
            $micromicro=0;
        }
         if($ing->materialidad_datos_tecnicos=="Cartulina-cartulina")
        {
             $canTotal2=number_format($datos->cantidad_1/1000,0,"","");
          // echo $canTotal2;exit;
            if($canTotal2>=1)
            {
                $cartulina=30*$canTotal2;
            }else
            {
                $cartulina=0;
            }
        }else
        {
            $cartulina=0;
        }
        if($ing->materialidad_datos_tecnicos=="Sólo Cartulina")
        {
           $emplacado=0;
        }else
        {
             $mermaEmplacadoArray=$this->variables_cotizador_model->getVariablesCotizadorPorId(35);
             $emplacado= $cantidad_1; /*Valor x dividido por Unidad por pliego*/

                $emplacado= $emplacado / 1000; /*Resultado de emplacado dividido por 1000*/                                       

                $emplacado= ($emplacado * 1000)+ 0.5; /*Emplacado multiplicado por 1000 y el resultado de la multiplicacion se suman 0.5*/                                  

            $emplacado= $emplacado/ 1000; /*emplacado dividido por 1000*/                   

                $emplacado = $emplacado +0.499; /*emplacado mas 0.499: Resultado emplacado es en decimales*/                                                               

                $Entero = number_format($emplacado,0,'',''); /* Guardar entero del emplacado*/                         

                $emplacado = $Entero * $mermaEmplacadoArray->precio; /*Multiplicar entero del emplacado por 15*/
           
        }
        
        //emplacado 2
        if($ing->materialidad_datos_tecnicos=="Sólo Cartulina")
        {
           $emplacado2=0;
        }else
        {
             $mermaEmplacadoArray=$this->variables_cotizador_model->getVariablesCotizadorPorId(35);
             $emplacado2= $cantidad_2; /*Valor x dividido por Unidad por pliego*/

                $emplacado2= $emplacado2 / 1000; /*Resultado de emplacado dividido por 1000*/                                       

                $emplacado2= ($emplacado2 * 1000)+ 0.5; /*Emplacado multiplicado por 1000 y el resultado de la multiplicacion se suman 0.5*/                                  

            $emplacado2= $emplacado2/ 1000; /*emplacado dividido por 1000*/                   

                $emplacado2 = $emplacado2 +0.499; /*emplacado mas 0.499: Resultado emplacado es en decimales*/                                                               

                $Entero = number_format($emplacado2,0,'',''); /* Guardar entero del emplacado*/                         

                $emplacado2 = $Entero * $mermaEmplacadoArray->precio; /*Multiplicar entero del emplacado por 15*/
           
        }
        
        if($fotomecanica->estan_los_moldes=="NO LLEVA" or $fotomecanica->estan_los_moldes=="CLIENTE LO APORTA" or $fotomecanica->materialidad_datos_tecnicos == 'Sólo Cartulina')
        {
            $troquelado=0;
        }else
        {

            $mermaTroqueladoArray=$this->variables_cotizador_model->getVariablesCotizadorPorId(36);
            if (($datos->cantidad_1>0) and ($ing->unidades_por_pliego>0))
                $troquelado=$datos->cantidad_1/$ing->unidades_por_pliego;
            else 
                $troquelado=0;
                $troquelado= $troquelado / 1000; /*Resultado de emplacado dividido por 1000*/                                                              
                $troquelado= ($troquelado * 1000)+ 0.5; /*Emplacado multiplicado por 1000 y el resultado de la multiplicacion se suman 0.5*/                          
                $troquelado= $troquelado/ 1000; /*emplacado dividido por 1000*/                      
                $troquelado = $troquelado +0.499; /*emplacado mas 0.499: Resultado emplacado es en decimales*/                                                               
                $EnteroTroquelado = number_format($troquelado,0,'',''); /* Guardar entero del emplacado*/                          
                $troquelado = $EnteroTroquelado * $mermaTroqueladoArray->precio; /*Multiplicar entero del emplacado por 15*/
        }
        //emplacado 3
        if($ing->materialidad_datos_tecnicos=="Sólo Cartulina")
        {
           $emplacado3=0;
        }else
        {
             $mermaEmplacadoArray=$this->variables_cotizador_model->getVariablesCotizadorPorId(35);
             $emplacado3= $cantidad_3; /*Valor x dividido por Unidad por pliego*/

                $emplacado3= $emplacado3 / 1000; /*Resultado de emplacado dividido por 1000*/                                       

                $emplacado3= ($emplacado3 * 1000)+ 0.5; /*Emplacado multiplicado por 1000 y el resultado de la multiplicacion se suman 0.5*/                                  

            $emplacado3= $emplacado3/ 1000; /*emplacado dividido por 1000*/                   

                $emplacado3 = $emplacado3 +0.499; /*emplacado mas 0.499: Resultado emplacado es en decimales*/                                                               

                $Entero = number_format($emplacado3,0,'',''); /* Guardar entero del emplacado*/                         

                $emplacado3 = $Entero * $mermaEmplacadoArray->precio; /*Multiplicar entero del emplacado por 15*/
           
        }
        //emplacado 4
        if($ing->materialidad_datos_tecnicos=="Sólo Cartulina")
        {
           $emplacado4=0;
        }else
        {
             $mermaEmplacadoArray=$this->variables_cotizador_model->getVariablesCotizadorPorId(35);
             $emplacado4= $cantidad_4; /*Valor x dividido por Unidad por pliego*/

                $emplacado4= $emplacado4 / 1000; /*Resultado de emplacado dividido por 1000*/                                       

                $emplacado4= ($emplacado4 * 1000)+ 0.5; /*Emplacado multiplicado por 1000 y el resultado de la multiplicacion se suman 0.5*/                                  

            $emplacado4= $emplacado4/ 1000; /*emplacado dividido por 1000*/                   

                $emplacado4 = $emplacado4 +0.499; /*emplacado mas 0.499: Resultado emplacado es en decimales*/                                                               

                $Entero = number_format($emplacado4,0,'',''); /* Guardar entero del emplacado*/                         

                $emplacado4 = $Entero * $mermaEmplacadoArray->precio; /*Multiplicar entero del emplacado por 15*/
           
        }
        
        if($fotomecanica->estan_los_moldes=="NO LLEVA" or $fotomecanica->estan_los_moldes=="CLIENTE LO APORTA" or $fotomecanica->materialidad_datos_tecnicos == 'Sólo Cartulina')
        {
            $troquelado=0;
        }else
        {

            $mermaTroqueladoArray=$this->variables_cotizador_model->getVariablesCotizadorPorId(36);
            if (($datos->cantidad_1>0) and ($ing->unidades_por_pliego>0))
                $troquelado=$datos->cantidad_1/$ing->unidades_por_pliego;
            else 
                $troquelado=0;
                $troquelado= $troquelado / 1000; /*Resultado de emplacado dividido por 1000*/                                                              
                $troquelado= ($troquelado * 1000)+ 0.5; /*Emplacado multiplicado por 1000 y el resultado de la multiplicacion se suman 0.5*/                          
                $troquelado= $troquelado/ 1000; /*emplacado dividido por 1000*/                      
                $troquelado = $troquelado +0.499; /*emplacado mas 0.499: Resultado emplacado es en decimales*/                                                               
                $EnteroTroquelado = number_format($troquelado,0,'',''); /* Guardar entero del emplacado*/                          
                $troquelado = $EnteroTroquelado * $mermaTroqueladoArray->precio; /*Multiplicar entero del emplacado por 15*/
        }
        
        //troquelado dos
        if($fotomecanica->estan_los_moldes=="NO LLEVA" or $fotomecanica->estan_los_moldes=="CLIENTE LO APORTA" or $fotomecanica->materialidad_datos_tecnicos == 'Sólo Cartulina')
        {
            $troquelado=0;
        }else
        {

            $mermaTroqueladoArray=$this->variables_cotizador_model->getVariablesCotizadorPorId(36);
            if (($datos->cantidad_2>0) and ($ing->unidades_por_pliego>0))
                $troquelado2=$datos->cantidad_2/$ing->unidades_por_pliego;
            else 
                $troquelado2=0;
                $troquelado2= $troquelado2 / 1000; /*Resultado de emplacado dividido por 1000*/                                                              
                $troquelado2= ($troquelado2 * 1000)+ 0.5; /*Emplacado multiplicado por 1000 y el resultado de la multiplicacion se suman 0.5*/                          
                $troquelado2= $troquelado2/ 1000; /*emplacado dividido por 1000*/                      
                $troquelado2 = $troquelado2 +0.499; /*emplacado mas 0.499: Resultado emplacado es en decimales*/                                                               
                $EnteroTroquelado2 = number_format($troquelado2,0,'',''); /* Guardar entero del emplacado*/                          
                $troquelado2 = $EnteroTroquelado2 * $mermaTroqueladoArray->precio; /*Multiplicar entero del emplacado por 15*/
        }
        //troquelado tres
        if($fotomecanica->estan_los_moldes=="NO LLEVA" or $fotomecanica->estan_los_moldes=="CLIENTE LO APORTA" or $fotomecanica->materialidad_datos_tecnicos == 'Sólo Cartulina')
        {
            $troquelado3=0;
        }else
        {

            $mermaTroqueladoArray=$this->variables_cotizador_model->getVariablesCotizadorPorId(36);
            if (($datos->cantidad_3>0) and ($ing->unidades_por_pliego>0))
                $troquelado3=$datos->cantidad_3/$ing->unidades_por_pliego;
            else 
                $troquelado3=0;
                $troquelado3= $troquelado3 / 1000; /*Resultado de emplacado dividido por 1000*/                                                              
                $troquelado3= ($troquelado3 * 1000)+ 0.5; /*Emplacado multiplicado por 1000 y el resultado de la multiplicacion se suman 0.5*/                          
                $troquelado3= $troquelado3/ 1000; /*emplacado dividido por 1000*/                      
                $troquelado3 = $troquelado3 +0.499; /*emplacado mas 0.499: Resultado emplacado es en decimales*/                                                               
                $EnteroTroquelado3 = number_format($troquelado3,0,'',''); /* Guardar entero del emplacado*/                          
                $troquelado3 = $EnteroTroquelado3 * $mermaTroqueladoArray->precio; /*Multiplicar entero del emplacado por 15*/
        }
        //troquelado cuatro
        if($fotomecanica->estan_los_moldes=="NO LLEVA" or $fotomecanica->estan_los_moldes=="CLIENTE LO APORTA" or $fotomecanica->materialidad_datos_tecnicos == 'Sólo Cartulina')
        {
            $troquelado4=0;
        }else
        {

            $mermaTroqueladoArray=$this->variables_cotizador_model->getVariablesCotizadorPorId(36);
            if (($datos->cantidad_4>0) and ($ing->unidades_por_pliego>0))
                $troquelado4=$datos->cantidad_4/$ing->unidades_por_pliego;
            else 
                $troquelado4=0;
                $troquelado4= $troquelado4 / 1000; /*Resultado de emplacado dividido por 1000*/                                                              
                $troquelado4= ($troquelado4 * 1000)+ 0.5; /*Emplacado multiplicado por 1000 y el resultado de la multiplicacion se suman 0.5*/                          
                $troquelado4= $troquelado4/ 1000; /*emplacado dividido por 1000*/                      
                $troquelado4 = $troquelado4 +0.499; /*emplacado mas 0.499: Resultado emplacado es en decimales*/                                                               
                $EnteroTroquelado4 = number_format($troquelado4,0,'',''); /* Guardar entero del emplacado*/                          
                $troquelado4 = $EnteroTroquelado4 * $mermaTroqueladoArray->precio; /*Multiplicar entero del emplacado por 15*/
        }
        if($totalTrabajosInternos=='No lleva'){$totalTrabajosInternos=0;}else{$totalTrabajosInternos=$totalTrabajosInternos*50;}
        if($totalTrabajosExternos=='No lleva'){$totalTrabajosExternos=0;}else{$totalTrabajosExternos=$totalTrabajosExternos*50;}
        //$sum=$color1+$color2+$can1+$can2+$bar1+$bar2+$laca+$folia+$termolaminado+$externo+$micromicro+$cartulina+$emplacado+$troquelado;
        //echo "<h1>".$totalTrabajosExternos."</h1>";
        
        //$sum=$color1+$color2+$can1+$can2+$bar1+$bar2+$laca+$folia+$totalTrabajosInternos+$externo+$micromicro+$cartulina+$emplacado+$troquelado;
        $sum=$color1+$color2+$can1+$bar1+$bar2+$externo+$micromicro+$cartulina+$emplacado+$troquelado;
        $sum2=$color1+$color2+$can3+$bar3+$bar4+$externo+$micromicro+$cartulina+$emplacado2+$troquelado2;
        $sum3=$color1+$color2+$can5+$bar5+$bar6+$externo+$micromicro+$cartulina+$emplacado3+$troquelado3;
        $sum4=$color1+$color2+$can7+$bar7+$bar8+$externo+$micromicro+$cartulina+$emplacado4+$troquelado4;

        
        if($fotomecanica->fot_lleva_barniz=='Laca UV'){
        $costosporlacado=(35000+(52*($datos->cantidad_1/$ing->unidades_por_pliego)));
        $costosporlacado2=(35000+(52*($datos->cantidad_2/$ing->unidades_por_pliego)));
        $costosporlacado3=(35000+(52*($datos->cantidad_3/$ing->unidades_por_pliego)));
        $costosporlacado4=(35000+(52*($datos->cantidad_4/$ing->unidades_por_pliego)));
        }else{
        $costosporlacado=0;
        $costosporlacado2=0;
        $costosporlacado3=0;
        $costosporlacado4=0;
        }
        
//echo $color1."<br>";
//echo $color2."<br>";
//echo $can7."<br>";
//
//echo $bar7."<br>";
//echo $bar8."<br>";
//echo $externo."<br>";
//echo $micromicro."<br>";
//echo $cartulina."<br>";
//echo $emplacado4."<br>";
//echo $troquelado4."<br>";exit();
//

//echo $bar1."</br>";        
//echo $bar2."</br>";        
//echo $bar3."</br>";        
//echo $bar4."</br>";        
//echo exit();        
        if(sizeof($hoja)>=1)
        {
            $arreglo55=array
                (
                    "total_merma"=>$sum,
                );
                $this->db->where('id', $hoja->id);
                $this->db->update("hoja_de_costos_datos",$arreglo55);
        }
       /**
        * fin validaciones mermas
        * */ 
       if (($datos->cantidad_1>0) and ($ing->unidades_por_pliego>0))
       {    
           $tiraje=$datos->cantidad_1/$ing->unidades_por_pliego;
       }
       else 
            $tiraje=0;
       if($tiraje<4000)
       {
         $tiraje2="Menos de 4.000";
         $factor_rangos=$this->variables_cotizador_model->getVariablesCotizadorPorId(17);
         $factor_rango=$factor_rangos->precio;
       }elseif($tiraje>4000 and $tiraje<10000)
       {
         $tiraje2="4.001 a 10.000";
         $factor_rangos=$this->variables_cotizador_model->getVariablesCotizadorPorId(18);
         $factor_rango=$factor_rangos->precio;
       }else
       {
        $tiraje2="Más de 10.000";
        $factor_rangos=$this->variables_cotizador_model->getVariablesCotizadorPorId(19);
        $factor_rango=$factor_rangos->precio;
       }
       
       //echo $factor_rango;exit();
       /**
        * pre impresión
        * */
        if($fotomecanica->fot_lleva_barniz=='Nada' || $fotomecanica->fot_lleva_barniz=='')
        {
            $barniz3=1;
        }else
        {
            $barniz3=0;
        }
        //echo $barniz3;exit;
        if($maquina=="Máquina Roland 800")
        {
            $recargoPlanchaArray=$this->variables_cotizador_model->getVariablesCotizadorPorId(26);
            $recargoPlancha=$recargoPlanchaArray->precio;
            $valorParaPlanchaMetal=1;
        }else
        {
            $recargoPlancha=0;
            $valorParaPlanchaMetal=0;
        }
        //echo $valorParaPlanchaMetal;exit;
        $arte=$this->variables_cotizador_model->getVariablesCotizadorPorId(1);
        $cantidadArte=$fotomecanica->colores*$arte->precio;

        $plancha_metal=$this->variables_cotizador_model->getVariablesCotizadorPorId(2);

        $cantidadPlantaMetal=(($fotomecanica->colores*$plancha_metal->precio)+($plancha_metal->precio*$barniz3))+(($fotomecanica->colores*$plancha_metal->precio)+($plancha_metal->precio*$barniz3))*$recargoPlancha/100*$valorParaPlanchaMetal;
        //echo $plancha_metal->precio;exit;
        //$cantidadPlantaMetal=(($fotomecanica->colores*$plancha_metal->precio)+($plancha_metal->precio*1));

        $copiado=$this->variables_cotizador_model->getVariablesCotizadorPorId(3);
        $cantidadCopiapo=(($fotomecanica->colores*$copiado->precio)+($copiado->precio*$barniz3))+(($fotomecanica->colores*$copiado->precio)+($copiado->precio*$barniz3))*$recargoPlancha/100*$valorParaPlanchaMetal;
         //$cantidadCopiapo=(($fotomecanica->colores*$copiado->precio)+($copiado->precio*$barniz3));
        $peliculasPreImpresion=$this->variables_cotizador_model->getVariablesCotizadorPorId(4);
        $peliculasVariable=$this->variables_cotizador_model->getVariablesCotizadorPorId(28);
        $cantidadPeliculas=$ing->tamano_a_imprimir_1*$ing->tamano_a_imprimir_2*$fotomecanica->colores*$peliculasVariable->precio;
        $montajePreImpresion=$this->variables_cotizador_model->getVariablesCotizadorPorId(5);
        $cantidadMontaje=$montajePreImpresion->precio*$fotomecanica->colores;
        if($datos->impresion_hacer_cromalin=='SI')
        {
           $cromalinVariable=$this->variables_cotizador_model->getVariablesCotizadorPorId(22);
           $cromalin=$cromalinVariable->precio;
           $coloresCromalin=1;
        }else
        {
           $cromalin=0;
           $coloresCromalin=0;
        }
                             
									
									
        if($fotomecanica->condicion_del_producto == 'Nuevo') //nuevo 
        {
            $coloresArte= $barniz3 + $fotomecanica->colores;
            $coloresPlanchaMetal= $fotomecanica->colores+$barniz3;
            //$coloresPlanchaMetal=($fotomecanica->colores+$barniz3)+($fotomecanica->colores/2);
//            $coloresCopiado=$fotomecanica->colores+$barniz3;
            $coloresCopiado=$fotomecanica->colores;
            //$coloresCopiado=($fotomecanica->colores+$barniz3)+($fotomecanica->colores/2);
            $coloresPeliculas=$barniz3 +$fotomecanica->colores;
            $coloresMontaje=$barniz3 +$fotomecanica->colores;
        }
					
        if($fotomecanica->condicion_del_producto == 'Repetición Sin Cambios') //
        {
            $coloresArte= 0;
            $coloresPlanchaMetal= $fotomecanica->colores+$barniz3;
            $coloresCopiado=$fotomecanica->colores;
            $coloresPeliculas=0;
            $coloresMontaje=0;
            $cantidadArte = 0;
            // se cobra $cantidadPlantaMetal = 0;
            // se cobra $cantidadCopiapo = 0;
            $cantidadPeliculas = 0;
            // se cobra $cantidadMontaje = 0;
        }					
        if($fotomecanica->condicion_del_producto == 'Repetición Con Cambios') //
        {
            //ver cambio de peliculas con fotomecanicas y validar
            $coloresArte= 0;
            $coloresPlanchaMetal= $fotomecanica->colores+$barniz3;
            $coloresCopiado=$fotomecanica->colores;
            $coloresPeliculas=0;
            $coloresMontaje=0;
            $cantidadArte = 0;
            $cantidadPeliculas = 0;
        }
        if($fotomecanica->condicion_del_producto == 'Producto Genérico') //
        {
            $coloresArte= 0;
            $coloresPlanchaMetal= 0;
            $coloresCopiado=0;
            $coloresPeliculas=0;
            $coloresMontaje=0;
        }
									
								//if($maquina=="Máquina Roland 800")
                                //{	
                                    /*$coloresArte= $barniz3 + $fotomecanica->colores;
                                    $coloresPlanchaMetal= $fotomecanica->colores+$barniz3;
                                    //$coloresPlanchaMetal=($fotomecanica->colores+$barniz3)+($fotomecanica->colores/2);
                                    $coloresCopiado=$fotomecanica->colores+$barniz3;
                                    //$coloresCopiado=($fotomecanica->colores+$barniz3)+($fotomecanica->colores/2);
                                    $coloresPeliculas=$barniz3 +$fotomecanica->colores;
                                    $coloresMontaje=$barniz3 +$fotomecanica->colores;*/
                                //}
                                /*else{
                                    $coloresArte=$fotomecanica->colores;
                                    $coloresPlanchaMetal=$fotomecanica->colores;
                                    $coloresCopiado=$fotomecanica->colores;
                                    $coloresPeliculas=$fotomecanica->colores;
                                    $coloresMontaje=$fotomecanica->colores;
                                }*/
                             $costoVenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(15);
                             $costoAdministracion=$this->variables_cotizador_model->getVariablesCotizadorPorId(16);
                             if ($datos->condicion_del_producto=='Repetición Sin Cambios')
                                $totalPreImpresion=$cantidadArte+$cantidadPlantaMetal+$cantidadCopiapo+$cantidadPeliculas+$cromalin;
                             else
                                $totalPreImpresion=$cantidadArte+$cantidadPlantaMetal+$cantidadCopiapo+$cantidadPeliculas+$cantidadMontaje+$cromalin;
                                 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>..:: Control de Gestión - Empresas Grau ::..</title>
	<meta charset="utf-8" />
      	<link rel="shortcut icon" href="<?php echo base_url()?>public/backend/img/favicon.ico" />
        <meta name="language" content="Spanish" />
        <meta name="copyright" content="www.cesarcancino.com" />
        <meta name="designer" content="César Cancino Zapata" />
        <meta name="author" content="www.cesarcancino.com" />

        
        <link type="text/css" rel="stylesheet" href="<?php echo base_url()?>bootstrap/bootstrap.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url()?>bootstrap/estilos.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url()?>public/backend/fancybox/jquery.fancybox.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url()?>public/frontend/css/prism.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url()?>public/frontend/css/chosen.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>public/backend/fancybox/jquery.fancybox.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>public/frontend/js/funciones.js"></script>
        <script type="text/javascript">var ruta='<?php echo base_url();?>';</script>
        <script type="text/javascript">
        $(document).ready(function() {
        	$(".fancybox").fancybox({
        		openEffect	: 'none',
        		closeEffect	: 'none'
        	});
            
        });
        </script>
        <style>
/*            body {
  background: rgb(204,204,204); 
}
.container{
    width: 21cm;
  height: 29.7cm; 
}*/
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page[size="A4"] {  
  width: 21cm;
  height: 29.7cm; 
  
}
page[size="A4"][layout="portrait"] {
  width: 29.7cm;
  height: 21cm;  
}
@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }
}
        </style>
    </head>
    <body>
    <!--<page size="A4">-->
        
    
    <form name="form" id="form" method="post" action="<?php echo base_url();?>hoja/save"> 
     <div class="container fuente">
    
            <header>
            
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones</a></li>
              <li class="active">Hoja de Costos <?php if(sizeof($hoja)>0){echo '<strong>(Guardada el '.fecha($hoja->fecha).')</strong>';}?></li>
            </ol>
                 <?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
            <?php endif; ?>
                <div>
                <h1><span id="titulo">Cartonajes Grau LTDA.</span> &nbsp;&nbsp;&nbsp; Hoja de Costos <?php if(sizeof($hoja)>0){echo '<span style="font-size: 13px;"><strong>(Guardada el '.fecha($hoja->fecha).')</strong><span>';}?>
               
                </h1>
                </div>
                <!--separador 20-->
                    <div class="separador_20"></div>
                    <!--/separador 20-->
                <div id="numero_de_costo">
                Número de Costo : <?php echo $id?> || Orden de Producción : <?php echo $orden->id_antiguo?> Número de Costo Antigua : <?php echo $datos->ot_antigua?>
                </div>
                <!--separador 20-->
                    <div class="separador_20"></div>
                    <!--/separador 20-->
                <div id="datos_basicos">
                    <!--tabla HTML-->
                    <table>
                        <?php if ($datos->ot_antigua!='') { ?>
                        <tr>
                            <td class="celda_1"><strong>NºC. Antigua<span class="derecha"> : </strong></span></td>
                            <td class="celda_2"><strong> <?php echo $datos->ot_antigua?></strong></td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4"></td>
                            <td class="celda_5"></td>
                        </tr>                        
                        <?php } ?>                        
                        <tr>
                            <td class="celda_1">Fecha <span class="derecha">:</span></td>
                            <td class="celda_2"><?php echo fecha($datos->fecha)?></td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4">Costeo <span class="derecha">:</span></td>
                            <td class="celda_5"><?php echo $user->nombre?></td>
                        </tr>
                        <tr>
                            <td class="celda_1">Nombre <span class="derecha">:</span></td>
                            <td class="celda_2"><?php echo $cli->razon_social?></td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4">E-Mail <span class="derecha">:</span></td>
                            <td class="celda_5"><?php echo $cli->correo?></td>
                        </tr>
                        <tr>
                            <td class="celda_1">Dirección <span class="derecha">:</span></td>
                            <td class="celda_2"><?php echo $cli->direccion?></td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4">RUT <span class="derecha">:</span></td>
                            <td class="celda_5"><?php echo esRut($cli->rut)?></td>
                        </tr>
                        <tr>
                            <td class="celda_1">Teléfono <span class="derecha">:</span></td>
                            <td class="celda_2"><?php echo $cli->telefono?></td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4">Ciudad <span class="derecha">:</span></td>
                            <td class="celda_5"><?php echo $cli->ciudad?></td>
                        </tr>
                        <tr>
                            <td class="celda_1">Vendedor <span class="derecha">:</span></td>
                            <td class="celda_2"><?php echo $vendedor->nombre?></td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4">Comuna <span class="derecha">:</span></td>
                            <td class="celda_5"><?php echo $cli->comuna?></td>
                        </tr>
                        <tr>
                            <td class="celda_1">&nbsp;</td>
                            <td class="celda_2">&nbsp;</td>
                            <td class="celda_3">&nbsp;</td>
                            <td class="celda_4">AT <span class="derecha">:</span></td>
                            <td class="celda_5"><?php echo $cli->contacto?></td>
                        </tr>
                    </table></div>
                    <!--/fin tabla HTML-->
                    <!--separador 20-->
<!--                    <div class="separador_20"></div>
                    /separador 20
                    <div id="numero_de_costo">
                    Descripción del trabajo
                    </div>-->
                    <!--separador 20-->
                    <div class="separador_20"></div>
                    <!--/separador 20-->
                    <?php
                    $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
                                        ?>
                    <div class="row">
                    <div style="float: left">
                        <table id="tabla_produccion" border="1" style="width: 10cm">
                                        
                                        <th colspan="3" align="center"><b>Descripcion del Trabajo</b></th>
                                        <tr>
                                            <td><b>Nombre Producto: </b><?php echo $ing->producto ?></td>
                                            <td><b>En placa: </b><?php echo $fotomecanica->materialidad_1?></td>
                                            <td><b>Liner: </b><?php echo $fotomecanica->materialidad_3 ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Impreso a: </b><?php echo $fotomecanica->colores ?> colores</td>
                                            <td><b>Reverso: </b><?php echo $materialidad_1->reverso?></td>
                                            <td><b>Reverso Liner: </b><?php echo $materialidad_1->reverso ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Barniz: </b><?php echo $fotomecanica->fot_lleva_barniz ?></td>
                                            <td><b>Onda: </b><?php echo $fotomecanica->materialidad_2 ?></td>
                                            <td><b>Tamaño: </b><?php echo "$tamano1 X $tamano2 cm"; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Reserva Barniz: </b><?php echo $fotomecanica->fot_reserva_barniz ?></td>
                                            <td><b>Reverso Onda: </b><?php echo $materialidad_2->reverso ?></td>
                                            <td></td>
                                        </tr>
                                    </table><br>
                    </div>
                    <div>
                        <table id="tabla_produccion" border="1" style="width: 10cm">
                                        
                                        <th colspan="3" align="center"><b>Descripcion del Trabajo</b></th>
                                        <tr>
                                            <td><b>Nombre Producto: </b><?php echo $ing->producto ?></td>
                                            <td><b>En placa: </b><?php echo $fotomecanica->materialidad_1?></td>
                                            <td><b>Liner: </b><?php echo $fotomecanica->materialidad_3 ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Impreso a: </b><?php echo $fotomecanica->colores ?> colores</td>
                                            <td><b>Reverso: </b><?php echo $materialidad_1->reverso?></td>
                                            <td><b>Reverso Liner: </b><?php echo $materialidad_1->reverso ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Barniz: </b><?php echo $fotomecanica->fot_lleva_barniz ?></td>
                                            <td><b>Onda: </b><?php echo $fotomecanica->materialidad_2 ?></td>
                                            <td><b>Tamaño: </b><?php echo "$tamano1 X $tamano2 cm"; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Reserva Barniz: </b><?php echo $fotomecanica->fot_reserva_barniz ?></td>
                                            <td><b>Reverso Onda: </b><?php echo $materialidad_2->reverso ?></td>
                                            <td></td>
                                        </tr>
                                    </table><br>
                    </div>
                    </div>
                    <div>
                        
                    <?php
                    $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
                                        
                  //  echo $ing->producto.', Impreso a '.$fotomecanica->colores.' colores, Barniz:'.$fotomecanica->fot_lleva_barniz.', Reserva:'.$fotomecanica->fot_reserva_barniz.', Cala caucho: '.$fotomecanica->fot_cala_caucho.', En Placa: '.$fotomecanica->materialidad_1.' Rev:'.$materialidad_1->reverso.'... onda: '.$fotomecanica->materialidad_2.' Rev:'.$materialidad_2->reverso.' ...liner: '.$fotomecanica->materialidad_3.' Rev:'.$materialidad_3->reverso.' Tamaño: '.$tamano1.' X '.$tamano2.' cm' ?>
                    </div>
                    <div class="separador_10"></div>
                    <div id="maquina">
                        <?php /*echo $maquina*/ /*echo 'Maquina Ralond 800';*/  echo '<strong><h6>Estado del producto: '.$fotomecanica->condicion_del_producto.'</h6></strong>';?>
                    </div>
                    <!--separador 20-->
                    <div class="separador_20"></div>
                    <!--/separador 20-->
                    <div>
                    <hr class="hr_punteada" />
                    Ancho : <?php echo $tamano1?> Cm, Largo : <?php echo $tamano2?> Cm, UNIDAD/PLIEGO : <?php echo $ing->unidades_por_pliego?>, COLORES : <?php echo $fotomecanica->colores?> <a href="<?php echo base_url()?>hoja/colores_fotomecanica/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a>, PIEZAS TOTALES EN EL PLIEGO(Para Desgajado) : <?php echo $ing->piezas_totales_en_el_pliego?>, TERMINACIÓN : <?php $acabado_1=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_1);echo $acabado_1->caracteristicas?>, Barniz Acuoso: <?php echo $fotomecanica->lleva_barniz?>  <a href="<?php echo base_url()?>hoja/datos_fotomecanica/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a>, Trabajo_Externo: <?php if($externo==0){echo 'NO';}else{echo 'SI';}?>
                    <hr class="hr_punteada" />
                    </div>
                    <div id="cantidad">
                    Valor por : <?php echo number_format($datos->cantidad_1,0,"",".")?> <a href="<?php echo base_url()?>hoja/cantidad/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a>
                    </div>
                  
                    <!--separador 20-->
                    <div class="separador_20"></div>
                    <!--/separador 20-->
                    <div>
                        <!--materialidad-->
                       
                        <table>
                            <tr>
                                <td class="celda_5 izquierda">
                                <?php
                                 switch($fotomecanica->materialidad_datos_tecnicos)
                                  {
                                    case 'Indefinido':
                                        $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
//                                        print_r($materialidad_3);
                                        $materialidad_4="No Aplica";
                                        $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
                                        $variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
                                        $formula=$materialidad_1->gramaje+($materialidad_1->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        if ($materialidad_2->precio>0) $materialidad_precio2=($materialidad_2->precio/1000); else $materialidad_precio2=0;
                                        if ($materialidad_3->precio>0) $materialidad_precio3=($materialidad_3->precio/1000); else $materialidad_precio3=0;
                                        if ($materialidad_2->gramaje>0) $materialidad_gramaje2=($materialidad_2->gramaje/1000); else $materialidad_gramaje2=0;
                                        $costo_kilo=0;
//                                        echo "costo_kilo=(((".$materialidad_2->gramaje."*(".$materialidad_2->precio."/1000)+((".$materialidad_2->gramaje."*(".$variable_cotizador->precio."/100)*".$materialidad_2->precio."/1000))+".$materialidad_3->gramaje."*".$materialidad_3->precio."/1000)/(".$materialidad_2->gramaje."+(".$materialidad_2->gramaje."*(".$variable_cotizador->precio."/100))+".$materialidad_3->gramaje.")))*1000";           
                                        if ($materialidad_2->gramaje>0)
                                            $costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+$materialidad_3->gramaje*$materialidad_3->precio/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje)))*1000;           
					else 	
                                            $costo_kilo=0;
//                                        echo $materialidad_3->tipo."======".$materialidad_3->reverso;
										
                                        if($materialidad_3->tipo == 14 and  $materialidad_3->reverso == 'Blanca')//valdivia
                                        {
//                                                echo "1==============";
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(44);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;
                                        }

                                        elseif($materialidad_3->tipo == 15 and  $materialidad_3->reverso == 'Blanca')//maule
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(45);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        elseif($materialidad_3->tipo == 1 and  $materialidad_3->reverso == 'Blanca') //Cartulina Importada
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(43);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        elseif($materialidad_3->tipo == 5 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        elseif($materialidad_3->tipo == 3 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        elseif($materialidad_3->tipo == 4 and  $materialidad_3->reverso == 'Café') // papel reverso cafe
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(41);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        else
                                        $costo_kilo_obtenido=140;
                                        $costo_kilo=$costo_kilo+$costo_kilo_obtenido;
                                        if(($fotomecanica->fot_lleva_barniz=='Nada')||($fotomecanica->fot_lleva_barniz==''))
                                        {
                                            $barniz2=0;
                                        }else
                                        {
                                            $barniz2=1;
                                        }

                                        if($maquina=="Máquina Roland 800")
                                         {
                                            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                            $recargo800Array=$this->variables_cotizador_model->getVariablesCotizadorPorId(34);
                                            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
                                            //echo $recargo800Array->precio."<br>".$tira1."<br>".$tira2;exit;
                                             
                                         }else
                                         {
                                            $tiraje=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);  
                                         
                                            
                                         }   
                                        
                                        if ($materialidad_2->gramaje>0)
                                            $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
					else 	
                                            $GramosMetroCuadrado=0;                                         
                                        $recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
                                        $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
                                        if(sizeof($hoja)>=1)
                                        {
                                            $arreglo54=array
                                                (
                                                    "gramos_metro_cuadrado"=>$GramosMetroCuadrado,
                                                );
                                                $this->db->where('id', $hoja->id);
                                                $this->db->update("hoja_de_costos_datos",$arreglo54);
                                        }
                                        if ($materialidad_2->gramaje>0)
                                            $costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+$materialidad_3->gramaje*$materialidad_3->precio/1000);
					else 	
                                            $costoMonotapaPorMetro2=0;     
//                                       exit($fotomecanica->estan_los_moldes);
                                       switch($fotomecanica->estan_los_moldes)
                                       {
                                          case 'NO':
                                            $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Nuevo</strong>)";
                                          break;
                                          case 'MOLDE GENERICO':
                                            if ($orden->id_molde!='')  
                                                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            else
                                                $molde=$this->moldes_model->getMoldesPorId($datos->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
                                          break;
                                          case 'MOLDE REGISTRADOS DEL CLIENTE':
                                            if ($orden->id_molde!='')  
                                                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            else
                                                $molde=$this->moldes_model->getMoldesPorId($datos->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
                                          break;                                          
                                          case 'NO LLEVA':
                                            $moldeNombre="<strong>NO ESTA MOLDE, PRODUCTO NO FABRICADO ANTERIORMENTE</strong>";
                                          break;
                                          case 'CLIENTE LO APORTA':
                                            $moldeNombre="<strong>CLIENTE LO APORTA</strong>";
                                          break;
                                       }
                                       
                                        $tapaNombre=$materialidad_1->nombre;
                                        $tapaGramaje=$materialidad_1->gramaje;
                                        $tapaFecha=$materialidad_1->fecha_ultima_actualizacion;
                                        $tapaPrecio=$materialidad_1->precio;
                                        $ondaNombre=$materialidad_2->nombre;
                                        if ($materialidad_2->gramaje>0)
                                            $ondaGramaje=$materialidad_2->gramaje;
					else 	
                                            $ondaGramaje=0;                                           
                                        $ondaFecha=$materialidad_2->fecha_ultima_actualizacion;
                                        $ondaPrecio=$materialidad_2->precio;
                                        $linerNombre=$materialidad_3->nombre;
                                        $linerGramaje=$materialidad_3->gramaje;
                                        $linerFecha=$materialidad_3->fecha_ultima_actualizacion;
                                        $linerPrecio=$materialidad_3->precio;
                                       ?>
                                       <a href="<?php echo base_url()?>hoja/materialidad/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a>
                                       <br />
                                        <span>Datos técnicos: </span> Indefinido (Migrado al Sistema)
                                        <br />
					<?php $tapa = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1) ?>
                                        <span>Tapa: </span> <?php echo $tapa->materiales_tipo?> / <strong>Gramaje:</strong> <?php echo $materialidad_1->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_1->precio?> / <strong>Reverso:</strong> <?php echo $materialidad_1->reverso?>
                                        <br />
					<?php $monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2) ?>
                                        <span>Onda: </span> <?php echo $monda->materiales_tipo ?> / <strong>Gramaje:</strong> <?php echo $materialidad_2->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_2->precio?> / <strong>Reverso:</strong> <?php echo $materialidad_2->reverso?>
                                        <br />
					<?php $mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3) ?>
                                        <span>Liner: </span> <?php echo $mliner->materiales_tipo ?> / <strong>Gramaje:</strong> <?php echo $materialidad_3->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_3->precio?>  / <strong>Reverso:</strong> <?php echo $materialidad_3->reverso?>
                                        <br />
                                        <!-- GR/ONDA <?php //echo $formula?>
                                        <br /> -->
                                        COSTO MONOTAPA POR KILO: <?php echo number_format($costo_kilo,0,'','.')?> &nbsp; GRAMOS ONDA M2 <?php echo $GramosMetroCuadrado?> &nbsp; COSTO MONOTAPA POR M2 <?php echo $costoMonotapaPorMetro2?>
                                        <br />
                                        IMPRESIÓN : <?php echo $fotomecanica->impresion?> <a href="<?php echo base_url()?>hoja/impresion/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a>
                                        <br />
                                        <?php // print_r($forma_pago); ?>
                                        Forma de Pago : <?php echo $forma_pago->forma_pago; ?> <a href="<?php echo base_url()?>hoja/forma_pago/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a>
                                        <br />
                                        <br />
                                        Molde : <?php echo $moldeNombre?> <!--
<a href="<?php echo base_url()?>hoja/moldes/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a>
-->
                                        <?php
                                    break;
                                    case 'Microcorrugado':
                                        $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
//                                        print_r($materialidad_1);
                                        $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
                                        $materialidad_4="No Aplica";
                                        $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
                                        $variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
                                        //print_r($base_imprenta);exit();
                                        $formula=$materialidad_1->gramaje+($materialidad_1->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        if ($materialidad_2->precio>0) $materialidad_precio2=($materialidad_2->precio/1000); else $materialidad_precio2=0;
                                        if ($materialidad_3->precio>0) $materialidad_precio3=($materialidad_3->precio/1000); else $materialidad_precio3=0;
                                        if ($materialidad_2->gramaje>0) $materialidad_gramaje2=($materialidad_2->gramaje/1000); else $materialidad_gramaje2=0;
                                        $costo_kilo=0;
                                        if (($materialidad_2->gramaje>0) and ($materialidad_3->gramaje>0) and ($materialidad_2->precio>0))
                                            $costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+$materialidad_3->gramaje*$materialidad_3->precio/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje)))*1000;           
					else 	
                                            $costo_kilo=0;
									
                                        if($materialidad_3->tipo == 14 and  $materialidad_3->reverso == 'Blanca')//valdivia
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(44);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;
                                        }
                                        elseif($materialidad_3->tipo == 15 and  $materialidad_3->reverso == 'Blanca')//maule
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(45);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        elseif($materialidad_3->tipo == 1 and  $materialidad_3->reverso == 'Blanca') //Cartulina Importada
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(43);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        elseif($materialidad_3->tipo == 5 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        elseif($materialidad_3->tipo == 3 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        elseif($materialidad_3->tipo == 4 and  $materialidad_3->reverso == 'Café') // papel reverso cafe
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(41);
                                                 $costo_kilo_obtenido=$recargoCostoKilo->precio;                                                 
                                        }
                                        else
                                        $costo_kilo_obtenido=140;
                                        //echo "530=".$costo_kilo."+".$costo_kilo_obtenido."</br>";                                        
                                        $costo_kilo=$costo_kilo+$costo_kilo_obtenido;

                                        if($fotomecanica->fot_lleva_barniz=='' || $fotomecanica->fot_lleva_barniz=='Nada')
                                        {
                                            $barniz2=0;
                                        }else
                                        {
                                            $barniz2=1;
                                        }

                                        if($maquina=="Máquina Roland 800")
                                         {
                                            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                            $recargo800Array=$this->variables_cotizador_model->getVariablesCotizadorPorId(34);
                                            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
                                            $tiraje=$tira1+$tira2;
                                            
//                                            echo $datos->cantidad_1."<br>";
//                                           echo $ing->unidades_por_pliego."<br>";
//                                           echo $sum."<br>";
//                                           echo $factor_rango."<br>";
//                                           echo $base_imprenta->precio."<br>";
//                                           echo $fotomecanica->colores."<br>";
//                                           echo $barniz2."<br>";
//                                            echo    $tiraje=$tira1+$tira2;exit();
                                         }else
                                         {
                                            $tiraje=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);  
                                         }   
                                        if ($materialidad_2->gramaje>0)
                                        {    
                                            $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
//                                            echo $GramosMetroCuadrado."=".$materialidad_2->gramaje."+(".$materialidad_2->gramaje."*(".$variable_cotizador->precio."/100))+".$materialidad_3->gramaje;
                                            
                                        }    
					else 	
                                            $GramosMetroCuadrado=0;                                         
                                        $recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
//                                        echo "</br>GramosMetroCuadrado=".$GramosMetroCuadrado."+".$recargoGramosDeAlmidon->precio."</br>";
                                        $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
                                        if(sizeof($hoja)>=1)
                                        {
                                            $arreglo54=array
                                                (
                                                    "gramos_metro_cuadrado"=>$GramosMetroCuadrado,
                                                );
                                                $this->db->where('id', $hoja->id);
                                                $this->db->update("hoja_de_costos_datos",$arreglo54);
                                        }
                                        if ($materialidad_2->gramaje>0){
                                            $costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+$materialidad_3->gramaje*$materialidad_3->precio/1000);
//                                            echo $costoMonotapaPorMetro2."=".$materialidad_2->gramaje."*(".$materialidad_2->precio."/1000)+((".$materialidad_2->gramaje."*(".$variable_cotizador->precio."/100)*".$materialidad_2->precio."/1000)+".$materialidad_3->gramaje."*".$materialidad_3->precio."/1000)</br>";                                        
                                        }
					else 	
                                            $costoMonotapaPorMetro2=0;                                           
                                       switch($fotomecanica->estan_los_moldes)
                                       {
                                          case 'NO':
                                            $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Nuevo</strong>)";
                                          break;
                                          case 'MOLDE GENERICO':
                                            if ($orden->id_molde!='')  
                                                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            else
                                                $molde=$this->moldes_model->getMoldesPorId($datos->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
                                          break;
                                          case 'MOLDE REGISTRADOS DEL CLIENTE':
                                            if ($orden->id_molde!='')  
                                                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            else
                                                $molde=$this->moldes_model->getMoldesPorId($datos->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
                                          break;   
                                          case 'NO LLEVA':
                                            $moldeNombre="<strong>NO ESTA MOLDE, PRODUCTO NO FABRICADO ANTERIORMENTE</strong>";
                                          break;
                                          case 'CLIENTE LO APORTA':
                                            $moldeNombre="<strong>CLIENTE LO APORTA</strong>";
                                          break;
                                       }
                                        $tapaNombre=$materialidad_1->nombre;
                                        $tapaGramaje=$materialidad_1->gramaje;
                                        $tapaFecha=$materialidad_1->fecha_ultima_actualizacion;
                                        $tapaPrecio=$materialidad_1->precio;
                                        $ondaNombre=$materialidad_2->nombre;
                                        if ($materialidad_2->gramaje>0)
                                            $ondaGramaje=$materialidad_2->gramaje;
					else 	
                                            $ondaGramaje=0;                                           
                                        $ondaFecha=$materialidad_2->fecha_ultima_actualizacion;
                                        $ondaPrecio=$materialidad_2->precio;
                                        $linerNombre=$materialidad_3->nombre;
                                        $linerGramaje=$materialidad_3->gramaje;
                                        $linerFecha=$materialidad_3->fecha_ultima_actualizacion;
                                        $linerPrecio=$materialidad_3->precio;
//                                        print_r($materialidad_1);
                                       ?>
                                       <a href="<?php echo base_url()?>hoja/materialidad/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a>
                                       <br />
                                        <span>Datos técnicos: </span> MicroCorrugado (Migrado al Sistema)
                                        <br />
					<?php $tapa = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1) ?>
                                        <span>Tapa: </span> <?php echo $tapa->materiales_tipo?> / <strong>Gramaje:</strong> <?php echo $materialidad_1->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_1->precio?> / <strong>Reverso:</strong> <?php echo $materialidad_1->reverso?>
                                        <br />
					<?php $monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2) ?>
                                        <span>Onda: </span> <?php echo $monda->materiales_tipo ?> / <strong>Gramaje:</strong> <?php echo $materialidad_2->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_2->precio?> / <strong>Reverso:</strong> <?php echo $materialidad_2->reverso?>
                                        <br />
					<?php $mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3) ?>
                                        <span>Liner: </span> <?php echo $mliner->materiales_tipo ?> / <strong>Gramaje:</strong> <?php echo $materialidad_3->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_3->precio?>  / <strong>Reverso:</strong> <?php echo $materialidad_3->reverso?>
                                        <br />
                                        <!-- GR/ONDA <?php //echo $formula?>
                                        <br /> -->
                                        COSTO MONOTAPA POR KILO: <?php echo number_format($costo_kilo,0,'','.')?> &nbsp; GRAMOS ONDA M2 <?php echo $GramosMetroCuadrado?> &nbsp; COSTO MONOTAPA POR M2 <?php echo $costoMonotapaPorMetro2?>
                                        <br />
                                        IMPRESIÓN : <?php echo $fotomecanica->impresion?> <a href="<?php echo base_url()?>hoja/impresion/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a>
                                        <br />
                                        <?php // print_r($forma_pago); ?>
                                        Forma de Pago : <?php echo $forma_pago->forma_pago; ?> <a href="<?php echo base_url()?>hoja/forma_pago/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a>
                                        <br />
                                        <br />
                                        Molde : <?php echo $moldeNombre?> <!--
<a href="<?php // echo base_url()?>hoja/moldes/<?php // echo $id?>/<?php // echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php // echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a>
-->
                                        <?php
                                    break;                                    
//                                    case 'Microcorrugado':
//                                        $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
//                                        $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
//                                        $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
//                                        $materialidad_4="No Aplica";
//                                        $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
//                                        $variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
//                                        $base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
//                                        $formula=$materialidad_1->gramaje+($materialidad_1->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
//                                        if ($materialidad_2->precio>0) $materialidad_precio2=($materialidad_2->precio/1000); else $materialidad_precio2=0;
//                                        if ($materialidad_3->precio>0) $materialidad_precio3=($materialidad_3->precio/1000); else $materialidad_precio3=0;
//                                        if ($materialidad_2->gramaje>0) $materialidad_gramaje2=($materialidad_2->gramaje/1000); else $materialidad_gramaje2=0;
//                                        
//                                        $costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+$materialidad_3->gramaje*$materialidad_3->precio/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje)))*1000;           
//										
//										
//										
//                                        if($materialidad_3->tipo == 14 and  $materialidad_3->reverso == 'Blanca')//valdivia
//                                        {
//                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(44);
//                                        }
//
//                                        if($materialidad_3->tipo == 15 and  $materialidad_3->reverso == 'Blanca')//maule
//                                        {
//                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(45);
//                                        }
//
//
//                                        if($materialidad_3->tipo == 1 and  $materialidad_3->reverso == 'Blanca') //Cartulina Importada
//                                        {
//                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(43);
//                                        }
//
//
//                                        if($materialidad_3->tipo == 5 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
//                                        {
//                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
//                                        }
//
//                                        if($materialidad_3->tipo == 3 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
//                                        {
//                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
//                                        }
//
//
//                                        if($materialidad_3->tipo == 4 and  $materialidad_3->reverso == 'Café') // papel reverso cafe
//                                        {
//                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(41);
//                                        }
//
//                                        $costo_kilo=$costo_kilo+$recargoCostoKilo->precio;
//                                        if($fotomecanica->lleva_barniz=='SI')
//                                        {
//                                            $barniz2=1;
//                                        }else
//                                        {
//                                            $barniz2=0;
//                                        }
//
//                                        if($maquina=="Máquina Roland 800")
//                                         {
//                                            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
//                                            $recargo800Array=$this->variables_cotizador_model->getVariablesCotizadorPorId(34);
//                                            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
//                                            $tiraje=$tira1+$tira2;
//                                            //echo $recargo800Array->precio."<br>".$tira1."<br>".$tira2;exit;
//                                         }else
//                                         {
//                                            $tiraje=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);  
//                                          
//                                         }    
//                                        $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
//                                        $recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
//                                        $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
//                                        if(sizeof($hoja)>=1)
//                                        {
//                                            $arreglo54=array
//                                                (
//                                                    "gramos_metro_cuadrado"=>$GramosMetroCuadrado,
//                                                );
//                                                $this->db->where('id', $hoja->id);
//                                                $this->db->update("hoja_de_costos_datos",$arreglo54);
//                                        }
//                                        $costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+$materialidad_3->gramaje*$materialidad_3->precio/1000);
//                                       switch($fotomecanica->estan_los_moldes)
//                                       {
//                                          case 'NO':
//                                            $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
//                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Nuevo</strong>)";
//                                          break;
//                                          case 'SI':
//                                            $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
//                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
//                                          break;
//                                          case 'NO LLEVA':
//                                            $moldeNombre="<strong>NO LLEVA MOLDE</strong>";
//                                          break;
//                                          case 'CLIENTE LO APORTA':
//                                            $moldeNombre="<strong>CLIENTE LO APORTA</strong>";
//                                          break;
//                                       }
//                                       
//                                        $tapaNombre=$materialidad_1->nombre;
//                                        $tapaGramaje=$materialidad_1->gramaje;
//                                        $tapaFecha=$materialidad_1->fecha_ultima_actualizacion;
//                                        $tapaPrecio=$materialidad_1->precio;
//                                        $ondaNombre=$materialidad_2->nombre;
//                                        $ondaGramaje=$materialidad_2->gramaje;
//                                        $ondaFecha=$materialidad_2->fecha_ultima_actualizacion;
//                                        $ondaPrecio=$materialidad_2->precio;
//                                        $linerNombre=$materialidad_3->nombre;
//                                        $linerGramaje=$materialidad_3->gramaje;
//                                        $linerFecha=$materialidad_3->fecha_ultima_actualizacion;
//                                        $linerPrecio=$materialidad_3->precio;
//                                       ?>
                                       <a href="//<?php echo base_url()?>hoja/materialidad/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a>
                                       <br />
                                        <span>Datos técnicos: </span> Microcorrugado
                                        <br />
					//<?php $tapa = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1) ?>
                                        <span>Tapa: </span> //<?php echo $tapa->materiales_tipo?> / <strong>Gramaje:</strong> <?php echo $materialidad_1->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_1->precio?> / <strong>Reverso:</strong> <?php echo $materialidad_1->reverso?>
                                        <br />
					//<?php $monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2) ?>
                                        <span>Onda: </span> //<?php echo $monda->materiales_tipo ?> / <strong>Gramaje:</strong> <?php echo $materialidad_2->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_2->precio?> / <strong>Reverso:</strong> <?php echo $materialidad_2->reverso?>
                                        <br />
					//<?php $mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3) ?>
                                        <span>Liner: </span> //<?php echo $mliner->materiales_tipo ?> / <strong>Gramaje:</strong> <?php echo $materialidad_3->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_3->precio?>  / <strong>Reverso:</strong> <?php echo $materialidad_3->reverso?>
                                        <br />
                                        <!-- GR/ONDA //<?php //echo $formula?>
                                        <br /> -->
                                        COSTO MONOTAPA POR KILO: //<?php echo number_format($costo_kilo,0,'','.')?> &nbsp; GRAMOS ONDA M2 <?php echo $GramosMetroCuadrado?> &nbsp; COSTO MONOTAPA POR M2 <?php echo $costoMonotapaPorMetro2?>
                                        <br />
                                        IMPRESIÓN : //<?php echo $fotomecanica->impresion?> <a href="<?php echo base_url()?>hoja/impresion/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a>
                                        <br />
                                        Forma de Pago : //<?php echo $forma_pago->forma_pago?> <a href="<?php echo base_url()?>hoja/forma_pago/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a>
                                        <br />
                                        <br />
                                        Molde : //<?php echo $moldeNombre?> <!--
<a href="//<?php // echo base_url()?>hoja/moldes/<?php // echo $id?>/<?php // echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php // echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a>
-->
                                        //<?php
//                                    break;
                                    case 'Corrugado'://la misma
                                        $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
                                        $materialidad_4="No Aplica";
                                        $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
                                        $variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
                                        $formula=$materialidad_1->gramaje+($materialidad_1->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        //echo $materialidad_2->gramaje."sss";exit;
                                        
                                        if (($materialidad_2->precio>0) and ($materialidad_3->gramaje>0) and ($materialidad_3->precio>0))
                                            $costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+$materialidad_3->gramaje*$materialidad_3->precio/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje)))*1000;           
                                        else 
                                            $costo_kilo=0;                                        
                                        if($materialidad_3->tipo == 14 and  $materialidad_3->reverso == 'Blanca')//valdivia
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(44);
                                        }
                                        if($materialidad_3->tipo == 15 and  $materialidad_3->reverso == 'Blanca')//maule
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(45);
                                        }
                                        if($materialidad_3->tipo == 1 and  $materialidad_3->reverso == 'Blanca') //Cartulina Importada
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(43);
                                        }
                                        if($materialidad_3->tipo == 5 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
                                        }
                                        if($materialidad_3->tipo == 3 and  $materialidad_3->reverso == 'Blanco') // papel reverso blanco/ white top
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(42);
                                        }
                                        if($materialidad_3->tipo == 4 and  $materialidad_3->reverso == 'Café') // papel reverso cafe
                                        {
                                                 $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(41);
                                        }
                                        $costo_kilo=$costo_kilo+$recargoCostoKilo->precio;
                                        if($fotomecanica->fot_lleva_barniz=='Nada' || $fotomecanica->fot_lleva_barniz=='')
                                        {
                                            $barniz2=0;
                                        }else
                                        {
                                            $barniz2=1;
                                        }
                                        /*
                                        if($maquina=="Máquina Roland 800")
                                        {
                                            $tiraje=(((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$fotomecanica->colores*$factor_rango)+$base_imprenta->precio*$fotomecanica->colores)+($barniz2*(($datos->cantidad_1/$barniz2)+$sum)*$factor_rango+$base_imprenta->precio*$barniz2)+(((($datos->cantidad_1/$barniz2)+$sum)*$fotomecanica->colores*$factor_rango+$base_imprenta->precio*$fotomecanica->colores)+(($barniz2*(($datos->cantidad_1/$barniz2)+$sum)*$factor_rango+$base_imprenta->precio*$barniz2)))*$barniz2*(30/100);   
                                            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                        }else
                                        {
                                            $tiraje=(((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$fotomecanica->colores*$factor_rango)+$base_imprenta->precio*$fotomecanica->colores)+($barniz2*(($datos->cantidad_1/$barniz2)+$sum)*$factor_rango+$base_imprenta->precio*$barniz2)+(((($datos->cantidad_1/$barniz2)+$sum)*$fotomecanica->colores*$factor_rango+$base_imprenta->precio*$fotomecanica->colores)+(($barniz2*(($datos->cantidad_1/$barniz2)+$sum)*$factor_rango+$base_imprenta->precio*$barniz2)))*$barniz2*(0/100);   
                                            //$valorParaPlanchaMetal
                                            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$BASE_imprenta->precio)*($fotomecanica->colores+$barniz2)*($valorParaPlanchaMetal*$recargor800/100);
                                        }
                                          */
                                        if($maquina=="Máquina Roland 800")
                                         {
                                            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                            $recargo800Array=$this->variables_cotizador_model->getVariablesCotizadorPorId(34);
                                            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
                                            $tiraje=$tira1+$tira2;
                                            //echo $recargo800Array->precio."<br>".$tira1."<br>".$tira2;exit;
//                                             echo $tira1."<br>";
//                                             echo $datos->cantidad_1."<br>";
//                                           echo $ing->unidades_por_pliego."<br>";
//                                           echo $sum."<br>";
//                                           echo $factor_rango."<br>";
//                                           echo $base_imprenta->precio."<br>";
//                                           echo $fotomecanica->colores."<br>";
//                                           echo $barniz2."<br>";exit();
                                         }else
                                         {
                                            $tiraje=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);  
                                          
                                         }    
                                        if  (($materialidad_2->gramaje>0) and ($materialidad_3->gramaje>0)) 
                                            $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        else
                                            $GramosMetroCuadrado=0;
                                        $recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
                                        $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
										
					if(sizeof($hoja)>=1)
                                        {
                                            $arreglo54=array
                                                (
                                                    "gramos_metro_cuadrado"=>$GramosMetroCuadrado,
                                                );
                                                $this->db->where('id', $hoja->id);
                                                $this->db->update("hoja_de_costos_datos",$arreglo54);
                                        }
                                        if (($materialidad_2->gramaje>0) and ($materialidad_3->gramaje>0) and ($materialidad_2->precio>0))
                                            $costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+$materialidad_3->gramaje*$materialidad_3->precio/1000);
                                        else
                                            $costoMonotapaPorMetro2=0;

                                        
                                        
//                                       if($fotomecanica->estan_los_moldes=='SI')
//                                       {
//                                            $molde=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);
//                                            $moldeNombre=$molde->nombre." N°".$molde->numero;
//                                       }else
//                                       {
//                                            $moldeNombre="Nuevo";
//                                       }
                                       
                                       switch($fotomecanica->estan_los_moldes)
                                       {
                                          case 'NO':
                                            $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Nuevo</strong>)";
                                          break;
                                          case 'MOLDE GENERICO':
                                            if ($orden->id_molde!='')  
                                                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            else
                                                $molde=$this->moldes_model->getMoldesPorId($datos->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
                                          break;
                                          case 'MOLDE REGISTRADOS DEL CLIENTE':
                                            if ($orden->id_molde!='')  
                                                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            else
                                                $molde=$this->moldes_model->getMoldesPorId($datos->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
                                          break;                                          
                                          case 'NO LLEVA':
                                            $moldeNombre="<strong>NO ESTA MOLDE, PRODUCTO NO FABRICADO ANTERIORMENTE</strong>";
                                          break;
                                          case 'CLIENTE LO APORTA':
                                            $moldeNombre="<strong>CLIENTE LO APORTA</strong>";
                                          break;
                                       }                                       
                                       
                                       
                                       
                                        $tapaNombre=$materialidad_1->nombre;
                                        $tapaGramaje=$materialidad_1->gramaje;
                                        $tapaFecha=$materialidad_1->fecha_ultima_actualizacion;
                                        $tapaPrecio=$materialidad_1->precio;
                                        $ondaNombre=$materialidad_2->nombre;
                                        $ondaGramaje=$materialidad_2->gramaje;
                                        $ondaFecha=$materialidad_2->fecha_ultima_actualizacion;
                                        $ondaPrecio=$materialidad_2->precio;
                                        $linerNombre=$materialidad_3->nombre;
                                        $linerGramaje=$materialidad_3->gramaje;
                                        $linerFecha=$materialidad_3->fecha_ultima_actualizacion;
                                        $linerPrecio=$materialidad_3->precio;                      
                                        ?>
					<a href="<?php echo base_url()?>hoja/materialidad/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a>
                                         <br />
                                        <span>Datos técnicos: </span> Corrugado
                                        <br />
                                        <span>Tapa: </span> <?php echo $fotomecanica->materialidad_1?> / <strong>Gramaje:</strong> <?php echo $materialidad_1->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_1->precio?> / <strong>Reverso:</strong> <?php echo $materialidad_1->reverso?>
                                        <br />
                                        <?php $monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2) ?>
                                        <span>Onda: </span> <?php echo  $monda->materiales_tipo ?> / <strong>Gramaje:</strong> <?php echo $materialidad_2->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_2->precio?> / <strong>Reverso:</strong> <?php echo $materialidad_2->reverso?>
                                        <br />
                                        <?php $mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3) ?>
                                        <span>Liner: </span> <?php echo $mliner->materiales_tipo ?> / <strong>Gramaje:</strong> <?php echo $materialidad_3->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_3->precio?> / <strong>Reverso:</strong> <?php echo $materialidad_3->reverso?>
                                        <br />
                                       <!-- GR/ONDA <?php //echo $formula?>
                                        <br /> -->
                                        COSTO MONOTAPA POR KILO: <?php echo number_format($costo_kilo,0,'','.')?> &nbsp; GRAMOS ONDA M2 <?php echo $GramosMetroCuadrado?> &nbsp; COSTO MONOTAPA POR M2 <?php echo $costoMonotapaPorMetro2?>
                                        <br />
                                        IMPRESIÓN : <?php echo $fotomecanica->impresion?>
                                        <br >
                                        Molde : <?php echo $moldeNombre?>
                                        <?php
                                    break;
                                    case 'Cartulina-cartulina': //Cartulina cartulina
                                        $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        $materialidad_3="No Aplica";;
                                        $materialidad_4="No Aplica";
                                        $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
                                        $variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
                                        if (($materialidad_2->precio>0) and ($materialidad_2->gramaje>0) and ($variable_cotizador->precio>0))
                                            $costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+0*0/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+0)))*1000;     
                                        else 
                                            $costo_kilo=0;
                                        $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $costo_kilo=$costo_kilo+$recargoCostoKilo->precio;
                                        if($fotomecanica->fot_lleva_barniz=='' || $fotomecanica->fot_lleva_barniz=='Nada')
                                        {
                                            $barniz2=0;
                                        }else
                                        {
                                            $barniz2=1;
                                        }
                                        if($maquina=="Máquina Roland 800")
                                         {
                                            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                            $recargo800Array=$this->variables_cotizador_model->getVariablesCotizadorPorId(34);
                                            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
                                            $tiraje=$tira1+$tira2;
                                            //echo $recargo800Array->precio."<br>".$tira1."<br>".$tira2;exit;
                                         }else
                                         {
                                            $tiraje=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);  
                                          
                                         }    
                                        if  ($materialidad_2->gramaje>0) 
                                            $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+0;
                                        else 
                                            $GramosMetroCuadrado=0;
                                        $recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
                                        $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
                                        if  ($materialidad_2->gramaje>0) 
                                            $costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+0*0/1000);
                                        else 
                                            $costoMonotapaPorMetro2=0;
                                        
//                                       if($fotomecanica->estan_los_moldes=='MOLDE GENERICO')
//                                       {
//                                            $molde=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);
//                                            $moldeNombre=$molde->nombre." N°".$molde->numero;
//                                       }
//                                       elseif($fotomecanica->estan_los_moldes=='MOLDE REGISTRADOS DEL CLIENTE')
//                                       {
//                                            $molde=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);
//                                            $moldeNombre=$molde->nombre." N°".$molde->numero;
//                                       }else                                           
//                                       {
//                                            $moldeNombre="Nuevo";
//                                       }      
                                        
                                       switch($fotomecanica->estan_los_moldes)
                                       {
                                          case 'NO':
                                            $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Nuevo</strong>)";
                                          break;
                                          case 'MOLDE GENERICO':
                                            if ($orden->id_molde!='')  
                                                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            else
                                                $molde=$this->moldes_model->getMoldesPorId($datos->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
                                          break;
                                          case 'MOLDE REGISTRADOS DEL CLIENTE':
                                            if ($orden->id_molde!='')  
                                                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            else
                                                $molde=$this->moldes_model->getMoldesPorId($datos->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
                                          break;                                          
                                          case 'NO LLEVA':
                                            $moldeNombre="<strong>NO ESTA MOLDE, PRODUCTO NO FABRICADO ANTERIORMENTE</strong>";
                                          break;
                                          case 'CLIENTE LO APORTA':
                                            $moldeNombre="<strong>CLIENTE LO APORTA</strong>";
                                          break;
                                       }                                        

                                        $tapaNombre=$materialidad_1->nombre;
                                        $tapaGramaje=$materialidad_1->gramaje;
                                        $tapaFecha=$materialidad_1->fecha_ultima_actualizacion;
                                        $tapaPrecio=$materialidad_1->precio;
										
                                        $tapaNombre2=$materialidad_2->nombre;
                                        $tapaGramaje2=$materialidad_2->gramaje;
                                        $tapaFecha2=$materialidad_2->fecha_ultima_actualizacion;
                                        $tapaPrecio2=$materialidad_2->precio;
                     
                                        ?>
                                        <span><strong>Datos técnicos: </strong> </span> Cartulina - Cartulina
                                        <br />
                                        <span><strong>Tapa: </strong> </span> <?php echo $fotomecanica->materialidad_1?> / <strong>Gramaje:</strong> <?php echo $materialidad_1->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_1->precio?> / <strong>Reverso:</strong> <?php echo $materialidad_1->reverso?>
                                        <br />
                                        <span><strong>Tapa (Respaldo): </strong> </span> <?php echo $fotomecanica->materialidad_2?> / <strong>Gramaje:</strong> <?php echo $materialidad_2->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_2->precio?> / <strong>Reverso:</strong> <?php echo $materialidad_2->reverso?>
                                        <!--<br />
                                        <?php //$mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3) ?>
                                        <span>Liner: </span> <?php //echo $mliner->materiales_tipo ?> / <strong>Gramaje:</strong> <?php //echo $materialidad_3->gramaje?> / <strong>Precio:</strong> <?php //echo $materialidad_3->precio?>
                                        <br />
                                        GR/ONDA <?php echo $formula?> -->
                                        <br />
                                        IMPRESIÓN : <?php echo $fotomecanica->impresion?>
                                        <br >
                                        Molde : <?php echo $moldeNombre?>
                                        <?php
                                        
                                    break;
                                    case 'Sólo Cartulina':
									
					$materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                                        //$materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                                        //$materialidad_3="No Aplica";;
                                        //$materialidad_4="No Aplica";
                                        $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);
                                        $variable_cotizador2=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $base_imprenta=$this->variables_cotizador_model->getVariablesCotizadorPorId(6);
										
                                        //$formula=$materialidad_1->gramaje+($materialidad_1->gramaje*($variable_cotizador->precio/100))+$materialidad_3->gramaje;
                                        //echo $materialidad_2->gramaje."sss";exit;
                                        //$costo_kilo=((($materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000))+0*0/1000)/($materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+0)))*1000;           
                                       //$recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(29);
                                        $recargoCostoKilo=$this->variables_cotizador_model->getVariablesCotizadorPorId(40);
                                        $costo_kilo=0;
                                        if($fotomecanica->fot_lleva_barniz=='' || $fotomecanica->fot_lleva_barniz=='Nada')
                                        {
                                            $barniz2=0;
                                        }else
                                        {
                                            $barniz2=1;
                                        }
                                        
                                        if($maquina=="Máquina Roland 800")
                                         {
                                            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);
                                            $recargo800Array=$this->variables_cotizador_model->getVariablesCotizadorPorId(34);
                                            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
                                            $tiraje=$tira1+$tira2;
                                            //echo $recargo800Array->precio."<br>".$tira1."<br>".$tira2;exit;
                                         }else
                                         {
                                            $tiraje=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2);  
                                          
                                         }    
                                        if  ($materialidad_2->gramaje>0) 
                                            $GramosMetroCuadrado=$materialidad_2->gramaje+($materialidad_2->gramaje*($variable_cotizador->precio/100))+0;
                                        else 
                                            $GramosMetroCuadrado=0;
                                        $recargoGramosDeAlmidon=$this->variables_cotizador_model->getVariablesCotizadorPorId(30);
                                        
                                        $GramosMetroCuadrado=$GramosMetroCuadrado+$recargoGramosDeAlmidon->precio;
                                        if  ($materialidad_2->gramaje>0) 
                                            $costoMonotapaPorMetro2=$materialidad_2->gramaje*($materialidad_2->precio/1000)+(($materialidad_2->gramaje*($variable_cotizador->precio/100)*$materialidad_2->precio/1000)+0*0/1000);
                                        else 
                                            $costoMonotapaPorMetro2=0; 
                                        
//                                       if($fotomecanica->estan_los_moldes=='MOLDE GENERICO')
//                                       {
//                                            $molde=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);
//                                            $moldeNombre=$molde->nombre." N°".$molde->numero;
//                                       }
//                                       elseif($fotomecanica->estan_los_moldes=='MOLDE REGISTRADOS DEL CLIENTE')
//                                       {
//                                            $molde=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);
//                                            $moldeNombre=$molde->nombre." N°".$molde->numero;
//                                       }else                                           
//                                       {
//                                            $moldeNombre="Nuevo";
//                                       }  
                                        
                                       switch($fotomecanica->estan_los_moldes)
                                       {
                                          case 'NO':
                                            $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Nuevo</strong>)";
                                          break;
                                          case 'MOLDE GENERICO':
                                            if ($orden->id_molde!='')  
                                                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            else
                                                $molde=$this->moldes_model->getMoldesPorId($datos->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
                                          break;
                                          case 'MOLDE REGISTRADOS DEL CLIENTE':
                                            if ($orden->id_molde!='')  
                                                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                                            else
                                                $molde=$this->moldes_model->getMoldesPorId($datos->numero_molde);
                                            $moldeNombre=$molde->nombre." N°".$molde->numero." (<strong>Molde Antiguo</strong>)";
                                          break;                                          
                                          case 'NO LLEVA':
                                            $moldeNombre="<strong>NO ESTA MOLDE, PRODUCTO NO FABRICADO ANTERIORMENTE</strong>";
                                          break;
                                          case 'CLIENTE LO APORTA':
                                            $moldeNombre="<strong>CLIENTE LO APORTA</strong>";
                                          break;
                                       }                                        
                                        $tapaNombre=$materialidad_1->nombre;
                                        $tapaGramaje=$materialidad_1->gramaje;
                                        $tapaFecha=$materialidad_1->fecha_ultima_actualizacion;
                                        $tapaPrecio=$materialidad_1->precio;
										
                                        $tapaNombre2=$materialidad_2->nombre;
                                        $tapaGramaje2=$materialidad_2->gramaje;
                                        $tapaFecha2=$materialidad_2->fecha_ultima_actualizacion;
                                        $tapaPrecio2=$materialidad_2->precio;
                     
                                        ?>
                                        <span><strong>Datos técnicos: </strong> </span> Sólo Cartulina
                                        <br />
                                        <span><strong>Tapa: </strong> </span> <?php echo $fotomecanica->materialidad_1?> / <strong>Gramaje:</strong> <?php echo $materialidad_1->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_1->precio?> / <strong>Reverso:</strong> <?php echo $materialidad_1->reverso?>
                                        <br />
                                        <span><strong>Tapa (Respaldo): </strong> </span> <?php echo $fotomecanica->materialidad_2?> / <strong>Gramaje:</strong> <?php echo $materialidad_2->gramaje?> / <strong>Precio:</strong> <?php echo $materialidad_2->precio?> / <strong>Reverso:</strong> <?php echo $materialidad_2->reverso?>
                                        <!--<br />
                                        <?php //$mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3) ?>
                                        <span>Liner: </span> <?php //echo $mliner->materiales_tipo ?> / <strong>Gramaje:</strong> <?php //echo $materialidad_3->gramaje?> / <strong>Precio:</strong> <?php //echo $materialidad_3->precio?>
                                        <br />
                                        GR/ONDA <?php echo $formula?> -->
                                        <br />
                                        IMPRESIÓN : <?php echo $fotomecanica->impresion?>
                                        <br >
                                        Molde : <?php echo $moldeNombre?>
                                        <?php	
                                    break;
                                    case 'Se solicita proposición':
                                        
                                    break;
                                  }  
                                ?>
                 </td>
                <td class="celda_5 valign_top">
                    <!--trabajos externos-->
                    <table border="1">
                            <tr>
                                <td class="celda_5" colspan="10"><strong>&nbsp;&nbsp;Trabajos Externos</strong></td>
                                <td class="celda_5" >&nbsp;Unidad de Uso&nbsp;</td>                                                
                                <td class="celda_5" >&nbsp;Cantidad&nbsp;</td>
                                <td class="celda_5" >&nbsp;Ancho&nbsp;</td>
                                <td class="celda_5" >&nbsp;Largo&nbsp;</td>
                                <td class="celda_5" >&nbsp;M2&nbsp;</td>
                                <td class="celda_5" >&nbsp;V. Unit.M2&nbsp;</td>												
                                <td class="celda_5" >&nbsp;C. Unit&nbsp;</td>
                                <td class="celda_5" >&nbsp;Total&nbsp;</td>                                                
                            </tr>
                                         
               <?php
                                $cantidad_4=0;
                                $externos_produccion=0;
                             //    exit($fotomecanica->acabado_impresion_4."hollaaa");
				if($fotomecanica->acabado_impresion_4=="17")
                                {
                                    $acabado_4="";
                                    $acabado_4Valor="";
                                    $acabado_4MedidaMasValorVenta="";
                                    $acabado_4Unitario="";
                                    $acabado_4UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_4Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_4);
                                    $acabado_4=$acabado_4Array->caracteristicas; // Nombre acabado
                                    $acabado_4UnidadVentaNombre=$acabado_4Array->unv; //Nombre unidad de venta
                                    $acabado_4Valor=$acabado_4Array->valor_venta; // ej: 52
                                    $acabado_4MedidaMasValorVenta=($tamano1*$tamano2*$acabado_4Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_4CostoFijo=$acabado_4Array->costo_fijo;	
								
                                    
                                    if ($acabado_4Array->unidad_de_venta == '1') //Metros
                                    {
                                        $costo_unitario4=$acabado_4MedidaMasValorVenta;
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_1);
                                        $cantidad_4=$datos->cantidad_1;
                                    }
                                    elseif ($acabado_4Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $costo_unitario4=$acabado_4Valor;
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }  
                                    elseif ($acabado_4Array->unidad_de_venta == '3') //tONELADA
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_1);
                                    }                                    
                                    elseif ($acabado_4Array->unidad_de_venta == '4') //caja de carton
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_1);
                                    }                                            
                                    elseif ($acabado_4Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($datos->cantidad_1*$acabado_4Valor);
                                        $cantidad_4=$datos->cantidad_1;
                                    }       
                                    elseif ($acabado_4Array->unidad_de_venta == '6') //cm2
                                    {
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $costo_unitario4=$acabado_4Valor;     
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }   
                                    elseif ($acabado_4Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario4=$acabado_4MedidaMasValorVenta;
                                        $precio_total_4=$acabado_4MedidaMasValorVenta*$datos->cantidad_1;
                                        $cantidad_4=$datos->cantidad_1;
                                    }
                                    elseif ($acabado_4Array->unidad_de_venta == '8') //cms
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_1);
                                    }           
                                    elseif ($acabado_4Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }     
                                    elseif ($acabado_4Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($acabado_4Valor*$datos->cantidad_1);
                                        $cantidad_4=$datos->cantidad_1;                                        
                                    }                                      
                                }
								
                                if($fotomecanica->acabado_impresion_5=="17")
                                {
                                    $acabado_5="";
                                    $acabado_5Valor="";
                                    $acabado_5MedidaMasValorVenta="";
                                    $acabado_5Unitario="";
                                    $acabado_5UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_5Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_5);
                                    $acabado_5=$acabado_5Array->caracteristicas;
                                    $acabado_5UnidadVentaNombre=$acabado_5Array->unv; //Nombre unidad de venta
                                    $acabado_5Valor=$acabado_5Array->valor_venta; // ej: 52
                                    $acabado_5MedidaMasValorVenta=($tamano1*$tamano2*$acabado_5Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_5CostoFijo=$acabado_5Array->costo_fijo;		
                                  if ($acabado_5Array->unidad_de_venta == '1') //mt2
                                    {
                                        $costo_unitario5=$acabado_5MedidaMasValorVenta;
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_1);                                      
                                        $cantidad_5=$datos->cantidad_1;
                                    }
                                    elseif ($acabado_5Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $costo_unitario5=$acabado_5Valor; 
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }    
                                    elseif ($acabado_5Array->unidad_de_venta == '3') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_1);
                                    }                                    
                                    elseif ($acabado_5Array->unidad_de_venta == '4') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_1);
                                    }                                            
                                    elseif ($acabado_5Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($datos->cantidad_1*$acabado_5Valor);
                                        $cantidad_5=$datos->cantidad_1;
                                    }       
                                    elseif ($acabado_5Array->unidad_de_venta == '6') //mt2
                                    {
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $costo_unitario5=$acabado_5Valor;
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }   
                                    elseif ($acabado_5Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario5=$acabado_5MedidaMasValorVenta;
                                        $precio_total_5=$acabado_5MedidaMasValorVenta*$datos->cantidad_1;
                                        $cantidad_5=$datos->cantidad_1;
                                    }
                                    elseif ($acabado_5Array->unidad_de_venta == '8') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_1);
                                    }           
                                    elseif ($acabado_5Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }   
                                    elseif ($acabado_5Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($acabado_5Valor*$datos->cantidad_1);
                                        $cantidad_5=$datos->cantidad_1;
                                    }                                      
                                }    
                                if($fotomecanica->acabado_impresion_6=="17")
                                {
                                    $acabado_6="";
                                    $acabado_6Valor="";
                                    $acabado_6MedidaMasValorVenta="";
                                    $acabado_6Unitario="";
                                    $acabado_6UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_6Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_6);
                                    $acabado_6=$acabado_6Array->caracteristicas;
                                    $acabado_6UnidadVentaNombre=$acabado_6Array->unv; //Nombre unidad de venta
                                    $acabado_6Valor=$acabado_6Array->valor_venta; // ej: 52
                                    $acabado_6MedidaMasValorVenta=($tamano1*$tamano2*$acabado_6Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_6CostoFijo=$acabado_6Array->costo_fijo;		
                                    if ($acabado_6Array->unidad_de_venta == '1') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_1);
                                    }
                                    elseif ($acabado_6Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $costo_unitario6=$acabado_6Valor; 
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    }  
                                    elseif ($acabado_6Array->unidad_de_venta == '3') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_1);
                                    }                                    
                                    elseif ($acabado_6Array->unidad_de_venta == '4') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_1);
                                    }                                            
                                    elseif ($acabado_6Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($datos->cantidad_1*$acabado_5Valor);
                                        $cantidad_6=$datos->cantidad_1;
                                    }       
                                    elseif ($acabado_6Array->unidad_de_venta == '6') //mt2
                                    {
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $costo_unitario6=$acabado_6Valor;
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    }   
                                    elseif ($acabado_6Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario6=$acabado_6MedidaMasValorVenta;
                                        $precio_total_6=$acabado_6MedidaMasValorVenta*$datos->cantidad_1;
                                        $cantidad_6=$datos->cantidad_1;
                                    }
                                    elseif ($acabado_6Array->unidad_de_venta == '8') //cms
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_1);
                                    }           
                                    elseif ($acabado_6Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    } 
                                    elseif ($acabado_6Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($acabado_6Valor*$datos->cantidad_1);
                                        $cantidad_6=$datos->cantidad_1;
                                    }                                      

                                }      //   echo $cantidad_4;exit();  
               ?>
               <tr>
                    <td class="celda_5" colspan="10">&nbsp;&nbsp;<?php str_replace("�", "ñ", ucwords(strtolower($acabado_4)));?>&nbsp;</td>
                    <td class="celda_5">&nbsp;<?php echo $acabado_4UnidadVentaNombre?>&nbsp;</td>
                    <td class="celda_5">&nbsp;<?php  if ($cantidad_4!="") echo $cantidad_4; ?>&nbsp;</td>
                    <td class="celda_3">&nbsp;<?php  if ($acabado_4UnidadVentaNombre!="") echo $tamano1; else echo ""; ?>&nbsp;</td>
                    <td class="celda_5">&nbsp;<?php  if ($acabado_4UnidadVentaNombre!="") echo $tamano2; else echo ""; ?>&nbsp;</td>
                    <td class="celda_5">&nbsp;<?php  if ($acabado_4UnidadVentaNombre!="") echo (($tamano1*$tamano2)/10000); else echo ""; ?>&nbsp;</td>												
                    <td class="celda_3">&nbsp;<?php  if ($acabado_4Valor>0) echo number_format($acabado_4Valor,0,'','.'); else echo ""; ?>&nbsp;</td>
                    <td class="celda_3">&nbsp;<?php  if ($costo_unitario4>0) echo number_format($costo_unitario4,0,'','.'); else echo ""; ?>&nbsp;</td>
                    <td class="celda_3">&nbsp;<?php  if ($precio_total_4>0) echo number_format($precio_total_4,0,'','.'); else echo ""; ?>&nbsp;</td>
                </tr>
                <tr>
                    <td class="celda_5" colspan="10">&nbsp;&nbsp;<?php echo ucwords(strtolower($acabado_5));?>&nbsp;</td>
                    <td class="celda_5">&nbsp;<?php echo $acabado_5UnidadVentaNombre?>&nbsp;</td>
                    <td class="celda_5">&nbsp;<?php  if ($cantidad_5!="") echo $cantidad_5; ?>&nbsp;</td>
                    <td class="celda_3">&nbsp;<?php  if ($acabado_5UnidadVentaNombre!="") echo $tamano1; else echo ""; ?>&nbsp;</td>
                    <td class="celda_5">&nbsp;<?php  if ($acabado_5UnidadVentaNombre!="") echo $tamano2; else echo ""; ?>&nbsp;</td>
                    <td class="celda_5">&nbsp;<?php  if ($acabado_5UnidadVentaNombre!="") echo (($tamano1*$tamano2)/10000); else echo ""; ?>&nbsp;</td>												
                    <td class="celda_3">&nbsp;<?php  if ($acabado_5Valor>0) echo number_format($acabado_5Valor,0,'','.'); else echo ""; ?>&nbsp;</td>
                    <td class="celda_3">&nbsp;<?php  if ($costo_unitario5>0) echo number_format($costo_unitario5,0,'','.'); else echo ""; ?>&nbsp;</td>
                    <td class="celda_3">&nbsp;<?php  if ($precio_total_5>0) echo number_format($precio_total_5,0,'','.'); else echo ""; ?>&nbsp;</td>
                </tr>
                <tr>
                    <td class="celda_5" colspan="10">&nbsp;&nbsp;<?php echo ucwords(strtolower($acabado_6));?>&nbsp;</td>
                    <td class="celda_5">&nbsp;<?php echo $acabado_6UnidadVentaNombre?>&nbsp;</td>
                    <td class="celda_5">&nbsp;<?php  if ($cantidad_6!="") echo $cantidad_6; ?>&nbsp;</td>
                    <td class="celda_3">&nbsp;<?php  if ($acabado_6UnidadVentaNombre!="") echo $tamano1; else echo ""; ?>&nbsp;</td>
                    <td class="celda_5">&nbsp;<?php  if ($acabado_6UnidadVentaNombre!="") echo $tamano2; else echo ""; ?>&nbsp;</td>
                    <td class="celda_5">&nbsp;<?php  if ($acabado_6UnidadVentaNombre!="") echo (($tamano1*$tamano2)/10000); else echo ""; ?>&nbsp;</td>												
                    <td class="celda_3">&nbsp;<?php  if ($acabado_6Valor>0) echo number_format($acabado_6Valor,0,'','.'); else echo ""; ?>&nbsp;</td>
                    <td class="celda_3">&nbsp;<?php  if ($costo_unitario6>0) echo number_format($costo_unitario6,0,'','.'); else echo ""; ?>&nbsp;</td>
                    <td class="celda_3">&nbsp;<?php  if ($precio_total_6>0) echo number_format($precio_total_6,0,'','.'); else echo ""; ?>&nbsp;</td>
                </tr>
                <tr>
                    <td class="celda_5" colspan="17"><strong>&nbsp;&nbsp;Total Precio de Trabajos Externos</strong></td>
                    <td>&nbsp;&nbsp;<?php if($hoja->valor_externo!=0){ $externos_produccion=$externos_produccion+$hoja->valor_externo; echo number_format($hoja->valor_externo,0,'','.');}else{  $externos_produccion=$precio_total_4+$precio_total_5+$precio_total_6; echo number_format($externos_produccion,0,'','.');} ?>&nbsp;&nbsp;<a href="<?php echo base_url()?>hoja/trabajos_externos/<?php echo $id?>/4" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="valor_externo" value="<?php if($hoja->valor_externo!=0){ echo number_format($hoja->valor_externo,0,'','.');}else{ echo number_format($externos_produccion,0,'','.');} ?>" /></td>
                </tr>                   
                <tr>
                    <td class="celda_5" colspan="10"><strong>&nbsp;&nbsp;Piezas Adicionales</strong></td>
                    <td class="celda_5">&nbsp;</td>
                    <td class="celda_5">&nbsp;</td>
                    <td class="celda_5">&nbsp;</td>
                    <td class="celda_5">&nbsp;</td>
                    <td class="celda_5">&nbsp;</td>												
                    <td class="celda_5">&nbsp;</td>
                    <td class="celda_5">&nbsp;</td>											
                    <td class="celda_5">&nbsp;</td>
                </tr>
                <?php

                if($ing->piezas_adicionales == 'NO LLEVA')
                {
                    $piezaAdacionalNom1 ="No Lleva";
                    $piezaAdacionalValor1="&nbsp;";
                    $piezaAdacionalTotal1="&nbsp;";
                    $piezaAdacionalEmpresa1="&nbsp;";
                }else
                {
                    $piezasAdicionales = $this->piezas_adicionales_model->getPiezasAdicionalesPorNombreHojaCosto($ing->piezas_adicionales);
                    $piezaUnidadVentaNombre1=$piezasAdicionales->unv; //Nombre unidad de venta
                    $piezaAdacionalNom1 = $piezasAdicionales->piezas_adicionales;
                    $piezaAdacionalValor1= $piezasAdicionales->valor_venta;
                    $piezaAdacionalTotal1 = $datos->cantidad_1 * $piezaAdacionalValor1;
                    $piezaAdacionalEmpresa1= $hoja->piezas_adicionales1;
                }
                if($ing->piezas_adicionales2 == 'NO LLEVA')
                {
                    $piezaAdacionalNom2 ="No Lleva";
                    $piezaAdacionalValor2="&nbsp;";
                    $piezaAdacionalTotal2="&nbsp;";
                    $piezaAdacionalEmpresa2="&nbsp;";
                }else
                {
                    $piezasAdicionales = $this->piezas_adicionales_model->getPiezasAdicionalesPorNombreHojaCosto($ing->piezas_adicionales2);
                    $piezaUnidadVentaNombre2=$piezasAdicionales->unv; //Nombre unidad de venta                                    
                    $piezaAdacionalNom2 = $piezasAdicionales->piezas_adicionales;
                    $piezaAdacionalValor2= $piezasAdicionales->valor_venta;
                    $piezaAdacionalTotal2= $datos->cantidad_2 * $piezaAdacionalValor2;
                    $piezaAdacionalEmpresa2= $hoja->piezas_adicionales2;
                }
                if($ing->piezas_adicionales3 == 'NO LLEVA')
                {
                    $piezaAdacionalNom3 ="No Lleva";
                    $piezaAdacionalValor3="&nbsp;";
                    $piezaAdacionalTotal3="&nbsp;";
                    $piezaAdacionalEmpresa3="&nbsp;";
                }else
                {
                    $piezasAdicionales = $this->piezas_adicionales_model->getPiezasAdicionalesPorNombreHojaCosto($ing->piezas_adicionales3);
                    $piezaUnidadVentaNombre3=$piezasAdicionales->unv; //Nombre unidad de venta                                    
                    $piezaAdacionalNom3 = $piezasAdicionales->piezas_adicionales;
                    $piezaAdacionalValor3 =  $piezasAdicionales->valor_venta;
                    $piezaAdacionalTotal3= $datos->cantidad_3 * $piezaAdacionalValor3;;
                    $piezaAdacionalEmpresa3= $hoja->piezas_adicionales3;
                }
                ?>
                <tr>
                <td class="celda_5" colspan="10">&nbsp;&nbsp;<?php echo ucwords(strtolower($piezaAdacionalNom1));?>&nbsp;</td>
                <td class="celda_5" >&nbsp;<?php echo $piezaUnidadVentaNombre1 ;?>&nbsp;</td>
                <td class="celda_5">&nbsp;<?php  if ($piezaUnidadVentaNombre1!="") echo $datos->cantidad_1; else echo ""; ?>&nbsp;</td>
                <td class="celda_5">&nbsp;</td>
                <td class="celda_5">&nbsp;</td>												
                <td class="celda_5">&nbsp;</td>
                <td class="celda_5">&nbsp;</td>												
                <td class="celda_5">&nbsp;<?php  if ($piezaUnidadVentaNombre1!="") echo $piezaAdacionalValor1; else echo ""; ?>&nbsp;</td>					
                <td class="celda_3">&nbsp;&nbsp;<?php echo number_format($piezaAdacionalTotal1,0,'','.');  ?>&nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td class="celda_5" colspan="10">&nbsp;&nbsp;<?php echo ucwords(strtolower($piezaAdacionalNom2));?>&nbsp;</td>
                <td class="celda_5" >&nbsp;<?php echo $piezaUnidadVentaNombre2 ;?>&nbsp;</td>                                                
                <td class="celda_5">&nbsp;<?php  if ($piezaUnidadVentaNombre2!="") echo $datos->cantidad_1; else echo ""; ?>&nbsp;</td>
                <td class="celda_5">&nbsp;</td>
                <td class="celda_5">&nbsp;</td>
                <td class="celda_5">&nbsp;</td>
                <td class="celda_5">&nbsp;</td>												
                <td class="celda_5">&nbsp;<?php  if ($piezaUnidadVentaNombre2!="") echo $piezaAdacionalValor2; else echo ""; ?>&nbsp;</td>					
                <td class="celda_3">&nbsp;&nbsp;<?php echo number_format($piezaAdacionalTotal2,0,'','.');  ?>&nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td class="celda_5" colspan="10">&nbsp;&nbsp;<?php echo ucwords(strtolower($piezaAdacionalNom3));?>&nbsp;</td>
                <td class="celda_5" >&nbsp;<?php echo $piezaUnidadVentaNombre3 ;?>&nbsp;</td>                                                
                <td class="celda_5">&nbsp;<?php  if ($piezaUnidadVentaNombre3!="") echo $datos->cantidad_1; else echo ""; ?>&nbsp;</td>
                <td class="celda_5">&nbsp;</td>
                <td class="celda_5">&nbsp;</td>												
                <td class="celda_5">&nbsp;</td>
                <td class="celda_5">&nbsp;</td>												
                <td class="celda_5">&nbsp;<?php  if ($piezaUnidadVentaNombre3!="") echo $piezaAdacionalValor3; else echo ""; ?>&nbsp;</td>					
                <td class="celda_3">&nbsp;&nbsp;<?php echo number_format($piezaAdacionalTotal3,0,'','.');  ?>&nbsp;&nbsp;</td>

                                                                                                      
            </tr>
                <tr>
                    <td class="celda_5" colspan="17"><strong>&nbsp;&nbsp;Total Precio de Piezas Adicionales</strong></td>
                    <td>&nbsp;&nbsp;<?php if($hoja->valor_piezas!=0){ $piezas_produccion=$piezas_produccion+$hoja->valor_piezas;  echo number_format($hoja->valor_piezas,0,'','.');}else{  $piezas_produccion=$piezaAdacionalTotal1+$piezaAdacionalTotal2+$piezaAdacionalTotal3; echo number_format($piezas_produccion,0,'','.');} ?>&nbsp;&nbsp;<a href="<?php echo base_url()?>hoja/trabajos_externos/<?php echo $id?>/5" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="valor_piezas" value="<?php if($hoja->valor_piezas!=0){ echo number_format($hoja->valor_piezas,0,'','.');}else{ echo number_format($piezas_produccion,0,'','.');} ?>" /></td>
                </tr>      
                <tr>
                    <td class="celda_5" colspan="17"><strong>&nbsp;&nbsp;Total Externos</strong></td>
                    <td class="celda_5" >&nbsp;<?php $externos_produccion=$externos_produccion; echo number_format(($externos_produccion),0,'','.');  ?>&nbsp;</td>
                    <!--<td class="celda_5" >&nbsp;<?php //$externos_produccion=$externos_produccion+$piezas_produccion; echo number_format(($externos_produccion),0,'','.');  ?>&nbsp;</td>-->
                </tr>                  
											
		
											
                </table>
                                    <!--/trabajos externos-->
                                </td>
                            </tr>
                        </table>
                        <!--/materialidad-->
                    </div>
                    <div class="separador_10"></div>
                    <div>
                        <table id="tabla_detalle">
                            <tr>
                                <td class="celda_3">MAT.PRIMAS</td>
                                <td class="celda_3">CANT/PLIEGO</td>
                                <td class="celda_3">VALOR $</td>
                                <td class="celda_3">PRODUCCIÓN</td>
                                <td class="celda_3">UNITARIO</td>
                                <td class="celda_3">VALOR $</td>
                            </tr>
                            <tr>
                                <td colspan="6"><hr class="hr_punteada" /></td>
                            </tr>
                        <?php
                            if (($datos->cantidad_1>0) and ($ing->unidades_por_pliego>0))
                                $costoPlacaKilo=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                            else 
                                $costoPlacaKilo=0;
                            $valorPlacaKilo=($costoPlacaKilo*$tamano1*$tamano2*$tapaGramaje)/10000000;
                            $totalPlacaKilo=$valorPlacaKilo*$tapaPrecio;
							
                             if(sizeof($hoja)>=1 and $hoja->fecha)
                            {
                                $arreglo5=array
                                (
                                    "placa_kilo"=>$costoPlacaKilo,
                                    "total_pliegos"=>$valorPlacaKilo,
                                );
                                $this->db->where('id', $hoja->id);
                                $this->db->update("hoja_de_costos_datos",$arreglo5);
                            }
			    if(sizeof($hoja)>=1)
                            {
                                $arreglokilo1=array
                                (
                                    "kilos_placa"=>$valorPlacaKilo,
                                 
                                );
                                $this->db->where('id', $hoja->id);
                                $this->db->update("hoja_de_costos_datos",$arreglokilo1);
                            }
                        ?>
                        <tr>
                                <td class="celda_3">TAPA KILO  :<?php echo number_format($valorPlacaKilo,0,'','.');/*echo $sum;*/?></td>
                                <td class="celda_3"><?php echo number_format($costoPlacaKilo,0,'','.')?></td>
                                <td class="celda_3"><?php echo number_format($totalPlacaKilo,0,'','.')?></td>
                                <td class="celda_3 valign_top padding_left_10" colspan="3" rowspan="30">
                                    <!--producción-->
                                    <table id="tabla_produccion">
                                        <tr>
                                            <td class="celda_33">TIRAJE</td>
                                            <td class="celda_33"><?php echo $factor_rango?></td>
                                            <td class="celda_33"><?php echo number_format($tiraje,0,'','.')?></td>
                                        </tr>
                                  <?php
                                  $variableComplemento=$this->variables_cotizador_model->getVariablesCotizadorPorId(32);
                                        $valorTiraje=$variableComplemento->precio-$tiraje;
										
                                        if($valorTiraje>0)
                                        {
                                            if($fotomecanica->colores == 0)
                                            {
                                              $complemento=0;
                                            }else{
                                              $complemento=$valorTiraje;	
                                            }
                                            
											
                                        }else
                                        {
                                            $complemento=0;
                                        }
                                        
                                        
                                  ?>  
					<?php if($hoja->valor_externo!=0){ $externos_produccion=$externos_produccion+$hoja->valor_externo; }else{  $externos_produccion=$precio_total_4+$precio_total_5+$precio_total_6; } ?>			  

								  
                    <tr>
                                            <td class="celda_33">COMPLEMENTO</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($complemento,0,'','.')?></td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33">EXTERNOS</td>
                                            <td class="celda_33">&nbsp;</td>

                                            <td class="celda_33"><?php echo number_format($externos_produccion,0,'','.');?></td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33">COSTOS POR LACADO</td>
                                            <td class="celda_33">&nbsp;</td>

                                            <td class="celda_33"><?php echo number_format($costosporlacado,0,'','.');?></td>
                                        </tr>
                    <?php
                        if($maquina=="Máquina Roland 800")
                        {
                           if (($datos->cantidad_1>0) and ($ing->unidades_por_pliego>0))
                                $costoOndaKilo=((($datos->cantidad_1/$ing->unidades_por_pliego)*1.04)+100)+4;
                            else 
                                $costoOndaKilo=0;                            
                        }else
                        {
                           if (($datos->cantidad_1>0) and ($ing->unidades_por_pliego>0))
                                $costoOndaKilo=(($datos->cantidad_1/$ing->unidades_por_pliego)+100)+4;
                            else 
                                $costoOndaKilo=0;                               
                        }
                        
                        if($fotomecanica->materialidad_datos_tecnicos == 'Sólo Cartulina')
                        {
                                $costoOndaKilo=0;
                                $valorOndaKilo=0;
                                $totalOndaKilo=0;
                                $valorCorte=0;

                        }else{
                            $valorOndaKilo=($costoOndaKilo*$tamano1*$tamano2*$GramosMetroCuadrado)/10000000;
                            $totalOndaKilo=$valorOndaKilo*$costo_kilo;
                            $valorCorte=$costoOndaKilo*4.5;
			}
                        
                        $costoOndaKilo1=((($datos->cantidad_1/$ing->unidades_por_pliego)*1.04)+100)+4;
                        $costoOndaKilo2=(($datos->cantidad_1/$ing->unidades_por_pliego)+$emplacado+$troquelado);
                        
                        if($costoOndaKilo1>$costoOndaKilo2){
                            $costoOndaKilo=$costoOndaKilo1;
                        }
                        if($costoOndaKilo1<$costoOndaKilo2){
                            $costoOndaKilo=$costoOndaKilo2;
                        }
                        
                    ?>
                    <tr>
                            <td class="celda_33">CORTE</td>
                            <td class="celda_33">4.5</td>
                            <td class="celda_33"><?php echo number_format($valorCorte,0,'','.')?></td>
                    </tr>
                    <?php
                        $variableEmplacado=$this->variables_cotizador_model->getVariablesCotizadorPorId(8);
                        $valorEmplacadado=($variableEmplacado->precio*$tamano1*$tamano2)/10000;
                        $totalEmplacado=$valorEmplacadado*$costoOndaKilo;
                    ?>
                    <tr>
                        <td class="celda_33">EMPLACADO</td>
                        <td class="celda_33"><?php echo $valorEmplacadado?></td>
                        <td class="celda_33"><?php echo number_format($totalEmplacado,0,'','.')?></td>
                    </tr>
                    <?php
                    
                        if($fotomecanica->estan_los_moldes == 'NO LLEVA')
                        {
                            $variableMontajeMoldeTroquel=0;
                            $totalMontajeMolde=0;
                        }else
                        {
                            $variableRecargoMontaje=$this->variables_cotizador_model->getVariablesCotizadorPorId(31);
                            $variableMontajeMoldeTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(10);
                            $totalMontajeMolde=$variableMontajeMoldeTroquel->precio*1.5;	
                        }                    

//                       
                    ?>
                    <tr>
                                            <td class="celda_33">MONTAJE MOLDE</td>
                                            <td class="celda_33"><?php echo number_format($variableMontajeMoldeTroquel->precio,0,'','.')?></td>
                                            <td class="celda_33"><?php echo number_format($totalMontajeMolde,0,'','.')?></td>
                                        </tr>
                    <?php
						if($fotomecanica->estan_los_moldes == 'NO LLEVA')
						{
                                                    $variableTroquelado=0;
                                                    $totalTroquelado=0;
						}else
						{
                                                    $variableTroquelado=$this->variables_cotizador_model->getVariablesCotizadorPorId(11);
                                                    $totalTroquelado=($costoOndaKilo*$variableTroquelado->precio)*1.5;	
						}                    
//					
                    ?>
                    <tr>
                                            <td class="celda_33">TROQUELADO</td>
                                            <td class="celda_33"><?php echo $variableTroquelado->precio?></td>
                                            <td class="celda_33"><?php echo number_format($totalTroquelado,0,'','.')?></td>
                    </tr>
                    <?php
                                        $variableDesgajado=$this->variables_cotizador_model->getVariablesCotizadorPorId(12);
                                        $totalDesgajado=$ing->piezas_totales_en_el_pliego*$variableDesgajado->precio*1.5*$costoOndaKilo;
                    ?>                                
                    <tr>                
                                            <td class="celda_33">DESGAJADO</td>
                                            <td class="celda_33"><?php echo $variableDesgajado->precio?></td>
                                            <td class="celda_33"><?php echo number_format($totalDesgajado,0,'','.')?></td>
                    </tr>
                     <tr>
                                            <td class="celda_33">PEGADO</td>
                                        <?php
                                           $variablePegado=$this->variables_cotizador_model->getVariablesCotizadorPorId(21);
                                           if(sizeof($hoja)==0) { 
                                               if ($datos->pegado_migrado==null || $datos->pegado_migrado=='' || $datos->pegado_migrado==0){
                                                   if($presupuesto->costo_pegado>=1){
                                                       $pegado_migrado=$presupuesto->costo_pegado;
                                                   }else{
                                                       $pegado_migrado=30; 
                                                   }
                                                }else{ 
                                                    $pegado_migrado=$datos->pegado_migrado;
                                                }
                                           }else{
                                                    $pegado_migrado=$hoja->pegado;
                                           }
                                           
                                           $totalPegado=$datos->cantidad_1*$pegado_migrado*$variablePegado->precio;
                                        ?>    
                                        <?php
                                        if(sizeof($hoja)==0) { 
                                                $variablePegado=$this->variables_cotizador_model->getVariablesCotizadorPorId(21);
                                                if ($datos->pegado_migrado==null){ 
                                                    //$pegado_migrado=1; 
                                                    $pegado_migrado=30; 
                                                }else{ 
                                                    $pegado_migrado=$datos->pegado_migrado;
                                                }
                                                $totalPegado=$datos->cantidad_1*$pegado_migrado*$variablePegado->precio;                                               
                                          ?>
                                                <td class="celda_33"><?php if($datos->pegado_migrado == ''){echo '30';}else{echo $datos->pegado_migrado;}?><a href="<?php echo base_url()?>hoja/pegado/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="pegado" placeholder="Descripcion técnica" value="<?php echo $datos->pegado_migrado?>" /></td>
					  <?php } else { 
                                                $variablePegado=$this->variables_cotizador_model->getVariablesCotizadorPorId(21);
                                                $totalPegado=$datos->cantidad_1*$hoja->pegado*$variablePegado->precio;                                              
                                          ?>
                                                <td class="celda_33"><?php if($hoja->pegado == ''){echo '30';}else{echo $hoja->pegado;}?><a href="<?php echo base_url()?>hoja/pegado/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="pegado" placeholder="Descripcion técnica" value="<?php echo $hoja->pegado?>" /></td>
					<?php }  ?>                                            
                                            
<!--                                            <td class="celda_33"><?php // if($hoja->pegado == ''){echo '30';}else{echo $hoja->pegado;}?><a href="<?php // echo base_url()?>hoja/pegado/<?php // echo $id?>/<?php // echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php // echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="pegado" placeholder="Descripcion técnica" value="<?php // echo $hoja->pegado?>" /></td>-->
                                                <td class="celda_33"><?php echo number_format($totalPegado,0,'','.')?><?php if ($datos->pegado_migrado==null){?> <strong> (Pegado de Cotizacion = 0 )</strong><?php } ?> </td> 
											
											
                     </tr>
                     <?php
					 if(sizeof($hoja->pegado)>=1)
					 {
                                            echo $divisionPegado=$hoja->pegado/2;
                                            $totalDespacho=$divisionPegado*$datos->cantidad_1;
					 }
					 else
					 {
                                             if ($datos->pegado_migrado==''){
                                                $divisionPegado=$presupuesto->costo_pegado/2;
                                             }else{
                                                $divisionPegado=$datos->pegado_migrado/2;
                                         }
                                             $totalDespacho=$divisionPegado*$datos->cantidad_1;	 
                                             echo "<h1>".$totalDespacho."</h1>";
                                         
                                             }
                                         
                                         echo "<h1>".$presupuesto->costo_pegado."</h1><br>";
                                         echo "<h1>".$totalDespacho."</h1><br>";
                                         echo "<h1>".$presupuesto->costo_pegado."</h1>";
					 
					 
                     
                     ?>
                     <tr>
                                            <td class="celda_33">DESPACHO</td>
                                            <td class="celda_33"><?php echo $divisionPegado?></td>
                                            <td class="celda_33"><?php echo number_format($totalDespacho,0,'','.')?></td>
                     </tr>
                     <?php
					 
					 	
					 
					 //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
					 
                    if($fotomecanica->condicion_del_producto == 'Nuevo') //nuevo 
                    {
                        if($fotomecanica->estan_los_moldes == 'NO')
			{
				$variableTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(9);
                                $moldeTroquel=$variableTroquel->precio;
                        }
                        elseif($fotomecanica->estan_los_moldes == 'NO LLEVA')
                        {
                            $moldeTroquel=0;
                        }elseif($fotomecanica->estan_los_moldes == 'CLIENTE LO APORTA')
                        {
                            $moldeTroquel=0;
                        }
                    }
                    if($fotomecanica->condicion_del_producto == 'Repetición Sin Cambios') //
                    {
//                        if($fotomecanica->estan_los_moldes == 'SI')
//			{
//				$variableTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(9);
//                                $moldeTroquel=$variableTroquel->precio;
//                        }
                    if($fotomecanica->estan_los_moldes == 'NO LLEVA')
                    {
                            $variableTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(9);
                            $moldeTroquel=$variableTroquel->precio;
                    }
                    }					
                    if($fotomecanica->condicion_del_producto == 'Repetición con Cambios') //
                    {
			$moldeTroquel=0;
                    }
                    if($fotomecanica->condicion_del_producto == 'Producto Genérico') //
                    {
			$moldeTroquel=0;
                    }
                    // $moldeTroquel=0;
                    //$variableTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(9);
                    //$moldeTroquel=$variableTroquel->precio;
                                            
									   
                     ?>
                     <tr>
                                            <td class="celda_33">MOLDE TROQUEL</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($moldeTroquel,0,'','.');?></td>
                                            <!-- <td class="celda_33"><?php //if($datos->condicion_del_producto=='Repetición Sin Cambios'){echo '0';}else{echo number_format($moldeTroquel,0,'','.');}?></td> -->
                     </tr>
					 <?php
					 $variableEmplacado=$this->variables_cotizador_model->getVariablesCotizadorPorId(39);
					 if($fotomecanica->lleva_barniz == 'SI' and $fotomecanica->reserva_barniz == 'SI')
					 {
						 $otrosCaucho = $variableEmplacado->precio; 
					 }else
					 {
						$otrosCaucho = 0;
					 }
                                         if($fotomecanica->fot_cala_caucho== 'Si')
										 {
											 $otrosCaucho = 50000; 
										 }else
										 {
											$otrosCaucho = 0;
										 }
					 
					 ?>
					 <tr>
                                            <td class="celda_33">CAUCHO</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($otrosCaucho,0,'','.');?></td>
                                            
                       
                     </tr>
					 <?php
					 if($piezaAdacionalEmpresa1 != 0)
					 {
						$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalEmpresa1;

					 }
					 else
					 {
						 	$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalTotal1;
						 
					 }
					 
					  if($piezaAdacionalEmpresa2 != 0)
					 {
						$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalEmpresa2;

					 }
					else
					 {
						 $TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalTotal2;
						 
					 }
					 
					 
					  if( $piezaAdacionalEmpresa3 != 0)
					 {
						$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalEmpresa3;

					 }
					else
					 {
						 $TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalTotal3;
						 
					 }
					 
					// $TotalPiezasAdicionales = $piezaAdacionalTotal1 + $piezaAdacionalTotal2 + $piezaAdacionalTotal3;
					 ?>
					 <tr>
                                            <td class="celda_33">PIEZAS ADICIONALES</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($TotalPiezasAdicionales,0,'','.');?></td>
                                        </tr>
					<tr>
                                            <td class="celda_33">VISTO BUENO EN MAQUINA</td>
<!--                                            SI ES SI EN COTIZACION-->
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php if($hoja->valor_bv_maquina == ''){ if ($datos->vb_maquina=="SI") $valor_bv_maquina=100000; else $valor_bv_maquina=0; echo number_format($valor_bv_maquina,0,'','.');}else{echo number_format($hoja->valor_bv_maquina,0,'','.'); $valor_bv_maquina=$hoja->valor_bv_maquina;}?><a href="<?php echo base_url()?>hoja/valores_extras/<?php echo $id?>/2" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="valor_bv_maquina" placeholder="Descripcion técnica" value="<?php echo $hoja->valor_bv_maquina?>" /></td>
                                        </tr>         
					 <tr>
                                            <td class="celda_33">NO ACEPTA EXCEDENTES</td>
<!--                                            SI ES SI EN COTIZACION-->
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php if($hoja->valor_acepeta_exce == ''){ if ($datos->acepta_excedentes=="SI") $valor_acepeta_exce=0; else $valor_acepeta_exce=100000; echo number_format($valor_acepeta_exce,0,'','.');}else{echo number_format($hoja->valor_acepeta_exce,0,'','.'); $valor_acepeta_exce=$hoja->valor_acepeta_exce;}?><a href="<?php echo base_url()?>hoja/valores_extras/<?php echo $id?>/3" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="valor_acepeta_exce" placeholder="Descripcion técnica" value="<?php echo $hoja->valor_acepeta_exce?>" /></td>
                                        </tr>                                        

                                            <td class="celda_33" colspan="3"><hr class="hr_punteada" /></td>
                     </tr>
                     <?php
                     $totalProduccion=$costosporlacado+$complemento+$valorCorte+$totalEmplacado+$totalMontajeMolde+$totalTroquelado+$totalPegado+$totalDespacho+$tiraje+$moldeTroquel+$totalDesgajado+$externos_produccion+$otrosCaucho + $TotalPiezasAdicionales + $valor_extra + $valor_bv_maquina + $valor_acepeta_exce;
                     echo $costosporlacado."aa<br>";
                     echo $complemento."<br>";
                     echo $valorCorte."<br>";
                     echo $totalEmplacado."<br>";
                     echo $totalMontajeMolde."<br>";
                     echo $totalTroquelado."<br>";
                     echo $totalPegado."<br>";
                     echo $totalDespacho."<br>";
                     echo $tiraje."<br>";
                     echo $moldeTroquel."<br>";
                     echo $totalDesgajado."<br>";
                     echo $externos_produccion."<br>";
                     echo $otrosCaucho."<br>";
                     echo $TotalPiezasAdicionales."<br>";
                     echo $valor_extra."<br>";
                     echo $valor_bv_maquina."<br>";
                     echo $valor_acepeta_exce."ff<br>";
//                     exit();
                     ?>
                     <tr>
                                            <td class="celda_33">TOTAL PRODUCCIÓN</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($totalProduccion,0,'','.')?></td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33" colspan="3">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33"><span class="subrayado">COSTOS VARIOS</span></td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">&nbsp;</td>
                     </tr>
                     <?php
                      //$totalMateriaPrima    
                      $costoVentaValor=(($totalOndaKilo+$totalPlacaKilo+$totalPreImpresion+$totalProduccion)*$costoVenta->precio)/100;
//                      echo  "venta=".$costoVentaValor."=((".$totalOndaKilo."+".$totalPlacaKilo."+".$totalPreImpresion."+".$totalProduccion.")*".$costoVenta->precio.")/100</br>";
                  
                     ?>
                     <tr>
                                            <td class="celda_33">COSTO VENTA</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($costoVentaValor,0,'','.')?></td>
                     </tr>
                     <?php
                      $costoAdministracionValor=(($totalOndaKilo+$totalPlacaKilo+$totalPreImpresion+$totalProduccion)*$costoAdministracion->precio)/100;
//                      echo "costoadministratuivo=".$costoAdministracionValor."=((".$totalOndaKilo."+".$totalPlacaKilo."+".$totalPreImpresion."+".$totalProduccion.")*".$costoAdministracion->precio.")/100";
                      
                     ?>
                     <tr>
                                            <td class="celda_33">COSTO ADMINISTRACIÓN</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($costoAdministracionValor,0,'','.')?></td>
                                        </tr>
<!--                                        <tr>
                                            <td class="celda_33">COSTO ADICIONAL</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php // echo $hoja->costo_adicional?><a href="<?php // echo base_url()?>hoja/costo_adicional/<?php // echo $id?>/<?php // echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php // echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="costo_adicional" value="<?php // echo $hoja->costo_adicional?>" /></td>
                     </tr>-->
					 <tr>
                                            <td class="celda_33">COSTO ADICIONAL POR UNIDAD</td>
                                            <td class="celda_33"><?php if($hoja->valor_extra == ''){ $valor_extra=$datos->varios_migrado; echo number_format($valor_extra,0,'','.');}else{echo number_format($hoja->valor_extra,0,'','.'); $valor_extra=$hoja->valor_extra;}?><a href="<?php echo base_url()?>hoja/valores_extras/<?php echo $id?>/1" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden"  id="valor_extra" name="valor_extra" value="<?php echo $valor_extra; ?>" /></td>
                                            <td class="celda_33"><?php echo number_format($hoja->valor_extra*$datos->cantidad_1,0,'','.') ?></td>
                                        </tr>                           
                     <?php
                      $totalCostosVarios=$costoAdministracionValor+$costoVentaValor+$hoja->costo_adicional+$valor_extra;
                     ?>
                     <tr>
                                            <td class="celda_33">TOTAL COSTOS VARIOS</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($totalCostosVarios,0,'','.')?></td>
                                        </tr>
                                    </table>
                                    <!--/producción-->
                                </td>
                            </tr>
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <?php
                            if(sizeof($hoja)>=1)
                            {
                                $arreglo6=array
                                (
                                    "onda_kilo"=>$costoOndaKilo,
                                );
                                $this->db->where('id', $hoja->id);
                                $this->db->update("hoja_de_costos_datos",$arreglo6);
                            }
							
							
							
                            ?>
                      <tr>
					  <?php
								if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
								{
									
									
							//$costoPlacaKilo2=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
							$costoPlacaKilo2 = ($datos->cantidad_1/$ing->unidades_por_pliego);
                            
							
							$dos_por_ciento = ($costoPlacaKilo2 / 100)* 2;
							
							if($costoPlacaKilo2 >= 1 and $costoPlacaKilo2 <= 100)
							{
								$agregado_a_apliegos = 100;
							}
							
							if($costoPlacaKilo2 > 100)
							{
								$agregado_a_apliegos = $dos_por_ciento;
							}
							$costoPlacaKilo2 = $costoPlacaKilo2 + $agregado_a_apliegos;
							$valorPlacaKilo2 = ($costoPlacaKilo2*$tamano1*$tamano2*$tapaGramaje2)/10000000;
                            $totalPlacaKilo2 = $valorPlacaKilo2*$tapaPrecio2;
							
					  ?>
										<td class="celda_3">TAPA KILO (RESPALDO):<?php echo number_format($valorPlacaKilo2,0,'','.');?></td>
										<td class="celda_3"><?php echo number_format($costoPlacaKilo2,0,'','.')?></td>
										<td class="celda_3"><?php echo number_format($totalPlacaKilo2,0,'','.')?></td>
					 <?php		
								}
								else
								{
						?>		
                                <td class="celda_3">ONDA KILO <?php echo number_format($valorOndaKilo,0,'','.');?></td>
                                <td class="celda_3"><?php echo number_format($costoOndaKilo,0,'','.')?></td>
                                <td class="celda_3"><?php echo number_format($totalOndaKilo,0,'','.')?></td>
								
							<?php
								}
							?>
                            </tr>
                            <!--
                            <tr>
                                <td class="celda_3">SEDAS</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            -->
                            <tr>
                                <td class="celda_3">VARIOS</td>
                                <td class="celda_3">0</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <?php
							if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
								{
									$totalMateriaPrima= $totalPlacaKilo+$totalPlacaKilo2;
								}else
								{
									$totalMateriaPrima= $totalOndaKilo+$totalPlacaKilo;	
								}
                            
                            ?>
                      <tr>
                                <td class="celda_3"><span class="subrayado_top">TOTAL MATERIA PRIMA</span></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($totalMateriaPrima,0,'','.')?></td>
                            </tr>
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                      <tr>
                                <td class="celda_3">PRE-IMPRESIÓN</td>
                                <td class="celda_3">CANTIDAD</td>
                                <td class="celda_3">VALOR $</td>
                            </tr>
                            <tr>
                                <td colspan="3"><hr class="hr_punteada" /></td>
                            </tr>
                            <tr>
                                <!--<td class="celda_3">ARTE <?php //echo $coloresArte?></td>-->
                                <td class="celda_3">ARTE <?php echo $coloresArte?></td>
                                <td class="celda_3"><?php echo number_format($arte->precio,0,'','.')?></td>
                                <td class="celda_3"><?php echo number_format($cantidadArte,0,'','.')?></td>
                            </tr>
                            <tr>
                                <td class="celda_3">PLANCHAMETAL <?php echo $coloresPlanchaMetal?></td>
                                <td class="celda_3"><?php echo number_format($plancha_metal->precio,0,'','.')?></td>
                                <td class="celda_3"><?php echo number_format($cantidadPlantaMetal,0,'','.')?></td>
                            </tr>
                            <tr>
                                <td class="celda_3">COPIADO <?php echo $coloresCopiado?></td>
                                <td class="celda_3"><?php echo number_format($copiado->precio,0,'','.')?></td>
                                <td class="celda_3"><?php echo number_format($cantidadCopiapo,0,'','.')?></td>
                            </tr>
                            <tr>
                                <td class="celda_3">PELÍCULAS <?php echo $coloresPeliculas?></td>
                                <td class="celda_3"><?php if($datos->condicion_del_producto=='Repetición Sin Cambios'){echo '0';}else{echo number_format($peliculasPreImpresion->precio,0,'','.');}?></td>
                                <td class="celda_3"><?php echo number_format($cantidadPeliculas,0,'','.')?></td>
                            </tr>
                            <tr>
                                <td class="celda_3">MONTAJE <?php echo $coloresMontaje?></td>
                                <td class="celda_3"><?php if($datos->condicion_del_producto=='Repetición Sin Cambios'){echo '0';}else{echo number_format($montajePreImpresion->precio,0,'','.');}?></td>
                                <?Php if ($datos->condicion_del_producto=='Repetición Sin Cambios') { ?>
                                <td class="celda_3"><?php echo number_format(0,0,'','.')?></td>
                                <?php } else { ?>
                                <td class="celda_3"><?php echo number_format($cantidadMontaje,0,'','.')?></td>
                                <?php } ?>                                
                            </tr>
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">CROMALÍN <?php echo $coloresCromalin?></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($cromalin,0,'','.')?></td>
                            </tr>
                            <tr>
                                <td colspan="3"><hr class="hr_punteada" /></td>
                            </tr>
                            <tr>
                                <td class="celda_3">TOTAL PRE-IMPRESIÓN</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($totalPreImpresion,0,'','.')?></td>
                            </tr>
                        </table>
                         <table id="tabla_detalle">
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="6"><hr class="hr_punteada" /></td>
                            </tr>
                         <?php
                        if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
                        {
                                $totalMateriaPrima2= $totalPlacaKilo+$totalPlacaKilo2;
                        }else
                        {
                                $totalMateriaPrima2= $totalOndaKilo+$totalPlacaKilo;	
                        }
                         ?>
                         <tr>
                                <td class="celda_3">TOTAL MATERIA PRIMA</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($totalMateriaPrima2,0,'','.')?></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">TOTAL PRE-IMPRESIÓN</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($totalPreImpresion,0,'','.')?></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">TOTAL PRODUCCIÓN</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($totalProduccion,0,'','.')?></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                         <?php
                          echo $totalTotal=$totalMateriaPrima2+$totalPreImpresion+$totalProduccion+$totalCostosVarios;
                          echo "<h1>".$totalMateriaPrima2."</h1><br>";
                          echo "<h1>".$totalPreImpresion."</h1><br>";
                          echo "<h1>".$totalProduccion."</h1><br>";
                          echo "<h1>".$totalCostosVarios."</h1><br>";
                          
                          
                          $totalValorUnitario=$totalTotal/$datos->cantidad_1;
                            //$totalValorUnitario2=$totalTotal/$datos->cantidad_2;
                            //$totalValorUnitario3=$totalTotal/$datos->cantidad_3;
                            //$totalValorUnitario4=$totalTotal/$datos->cantidad_4;
//                          echo "valorFinal=((".$totalValorUnitario."/(100-".$datos->margen_migrado."))/100)*10000";
                          
                          if ($hoja->margen!="") {
                            $valorFinal=(($totalValorUnitario/(100-$hoja->margen))/100)*10000;
                          
                            echo "<h1>".$totalValorUnitario."</h1><br>";
                            echo "<h1>".$hoja->margen."</h1>";
                            
                            echo "<h1>1</h1>";
                            echo $valorFinal;
                          }else{ 
                              if($datos->margen_migrado!=0 || $datos->margen_migrado!=null){
                                  $valorFinal=(($totalValorUnitario/(100-$datos->margen_migrado))/100)*10000;
                                  $valorFinal2xxx = $this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_2,2);
                                  $valorFinal3xxx = $this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_3,3);
                                  $valorFinal4xxx = $this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_4,4);
                                  echo "<h1>1 de bd</h1>";
                                  echo "<h1>".$totalValorUnitario."</h1><br>";
                            echo "<h1>".$hoja->margen."</h1>";
                            echo $valorFinal;
                              }else{
                                  $valorFinal=(($totalValorUnitario/(100-15))/100)*10000;
                                  echo "<h1>".$totalValorUnitario."</h1><br>";
                            echo "<h1>".$hoja->margen."</h1>";
                                  
                                  echo "<h1>2 es 15</h1>";
                            echo $valorFinal;
                                  $valorFinal2xxx = $this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_2,2);
                                  $valorFinal3xxx = $this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_3,3);
                                  $valorFinal4xxx = $this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_4,4);
                              }
//                          echo "<h1>2</h1>";
//                          echo "<h1>".$datos->margen_migrado."</h1>";
                          }
                         ?>
                          <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><span class="subrayado">VALOR POR</span></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($datos->cantidad_1,0,'','.')?></td>
                            </tr>                                
                          <tr>
                                <td class="celda_3">TOTAL COSTOS VARIOS</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($totalCostosVarios,0,'','.')?></td>
                                <td class="celda_3"><span class="subrayado">VALOR FINAL</span></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($valorFinal,0,'','.')?></td>
                            </tr>
                        
                <?php
                            $vcostoFinanciero=$this->variables_cotizador_model->getVariablesCotizadorPorId(33);
                            $recargoPorCantidadJusta=$this->variables_cotizador_model->getVariablesCotizadorPorId(37);
										
                            //if($datos->acepta_excedentes=='SI')
                           // {
//                            echo $valorFinal."<br>";
//                            echo $valorFinal."<br>";
//                            echo $valorFinal."<br>";
                            $valorFinanciado=$valorFinal*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
                         //   echo   "<h1>".$valorFinanciado."</h1>";exit();
                            //valorfinal*((((3.5/30)*30)+100))/100;
//                          
//                              exit($valorFinanciado."aquiii");
                            $valorFinanciado2=$valorFinal2xxx*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
                            $valorFinanciado3=$valorFinal3xxx*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
                            $valorFinanciado4=$valorFinal4xxx*(((( $vcostoFinanciero->precio/30)*$forma_pago->dias)+100))/100;
							//}
							
                            if($datos->acepta_excedentes=='NO')
                            {
                                $valorFinanciado=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado);
                                $valorFinanciado2=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado2);
                                $valorFinanciado3=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado3);
                                $valorFinanciado4=(((100+$recargoPorCantidadJusta->precio)/100)*$valorFinanciado4);
                            }
                ?>
							<tr>
                                <td colspan="3"><hr class="hr_punteada" /></td>
                                <td class="celda_3">VALOR FINANCIADO <?php echo $forma_pago->forma_pago?> (<?php echo $forma_pago->dias?>)</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($valorFinanciado,0,'','.')?> <input type="hidden" name="valor_financiado" value="<?php echo $valorFinanciado?>" /> </td>
								
                            </tr>
                            <?php
                           // echo sizeof($hoja)."holaa";
                                if(sizeof($hoja)==0)
                                {
                                    if(($fotomecanica->materialidad_datos_tecnicos=="Indefinido") or ($fotomecanica->materialidad_datos_tecnicos=="Microcorrugado") or ($fotomecanica->materialidad_datos_tecnicos=="Corrugado")  or ($fotomecanica->materialidad_datos_tecnicos=="Cartulina-cartulina"))
                                    {        
                                        $valorEmpresa=$datos->precio_migrado;
                                    }
                                    else {
                                        $valorEmpresa=$valorFinanciado;
                                    }                                    
                                }else
                                {
                                    //$valorEmpresa=$hoja->valor_empresa;
                                    if(($fotomecanica->materialidad_datos_tecnicos=="Indefinido") or ($fotomecanica->materialidad_datos_tecnicos=="Microcorrugado") or ($fotomecanica->materialidad_datos_tecnicos=="Corrugado")  or ($fotomecanica->materialidad_datos_tecnicos=="Cartulina-cartulina"))
                                    {        
                                        $valorEmpresa=$datos->precio_migrado;
                                    }
                                    else {
                                        $valorEmpresa=$valorFinanciado;
                                    }      
                                }
                                echo "<h1>".$valorEmpresa."</h1>";
                               
                            ?>
                            <tr>
                                <td class="celda_3">TOTAL</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($totalTotal,0,'','.')?></td>
                                <td class="celda_3">VALOR EMPRESA</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php if(sizeof($hoja)==0){if($valorEmpresa == 0){ echo number_format($valorFinanciado,0,'','.'); $valorEmpresa=$valorFinanciado;}else{echo number_format($valorEmpresa,0,'','.');}}else{echo number_format($hoja->valor_empresa,0,'','.');}?><a href="<?php echo base_url()?>hoja/valor_empresa/<?php echo $id?>/<?php echo $pagina?>/<?php echo $valorFinanciado;?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="valor_empresa" value="<?php echo $valorEmpresa?>" /></td>
                            </tr
                             <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">DÍAS DE ENTREGA</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php if(sizeof($hoja)==0){echo '20';}else{echo $hoja->dias_de_entrega;}?><a href="<?php echo base_url()?>hoja/dias/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="dias_de_entrega" value="<?php echo $hoja->dias_de_entrega?>" /></td>
                            </tr>
                            <tr>
                                <td class="celda_3">VALOR UNITARIO</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($totalValorUnitario,0,'','.')?></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">MARGEN</td>
                                        <?php
                                        if(sizeof($hoja)==0) { ?>
                                        <td class="celda_3"><?php if($datos->margen_migrado!=0 || $datos->margen_migrado!= null){echo $datos->margen_migrado;}else{echo "15";} ?> <a href="<?php echo base_url()?>hoja/margen/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="margen" value="<?php if($datos->margen_migrado!=0 || $datos->margen_migrado!= null){echo $datos->margen_migrado;}else{echo "15";} ?>" /></td>
					  <?php } else { ?>
                                        <td class="celda_3"><?php if($hoja->margen == null){echo '15';}else{echo $hoja->margen;}?> <a href="<?php echo base_url()?>hoja/margen/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="margen" value="<?php echo $hoja->margen?>" /></td>
					<?php }  ?>                                     
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                        </table>
                        <div class="separador_20">&nbsp;</div>
                        <?php
                        
                       if(sizeof($hoja)==0) { 
                        $variablePegado=$this->variables_cotizador_model->getVariablesCotizadorPorId(21);
                        if ($datos->pegado_migrado==null) $pegado_migrado=1; else $pegado_migrado=$datos->pegado_migrado;
                        $totalPegado=$datos->cantidad_2*$pegado_migrado*$variablePegado->precio;                                               
                        $totalPegado2=$datos->cantidad_3*$pegado_migrado*$variablePegado->precio;                                               
                        $totalPegado3=$datos->cantidad_4*$pegado_migrado*$variablePegado->precio;                                               
                         } else { 
                        $variablePegado=$this->variables_cotizador_model->getVariablesCotizadorPorId(21);
                        $totalPegado=$datos->cantidad_2*$hoja->pegado*$variablePegado->precio;                                              
                        $totalPegado2=$datos->cantidad_3*$hoja->pegado*$variablePegado->precio;                                              
                        $totalPegado3=$datos->cantidad_4*$hoja->pegado*$variablePegado->precio;                                              
                        }
                        
                        if(sizeof($hoja->pegado)>=1)
                         {
                            $divisionPegado=$hoja->pegado/2;
                            $totalDespacho=$divisionPegado*$datos->cantidad_2;
                         }
                         else
                         {
                             if ($datos->pegado_migrado=='')
                                $divisionPegado=$presupuesto->costo_pegado/2;
                             else
                                $divisionPegado=$datos->pegado_migrado/2;
                             $totalDespacho=$divisionPegado*$datos->cantidad_2;	 
                         }
                        if(sizeof($hoja->pegado)>=1)
                         {
                            $divisionPegado=$hoja->pegado/2;
                            $totalDespacho2=$divisionPegado*$datos->cantidad_3;
                         }
                         else
                         {
                             if ($datos->pegado_migrado=='')
                                $divisionPegado=$presupuesto->costo_pegado/2;
                             else
                                $divisionPegado=$datos->pegado_migrado/2;
                             $totalDespacho2=$divisionPegado*$datos->cantidad_3;	 
                         }
                        if(sizeof($hoja->pegado)>=1)
                         {
                            $divisionPegado=$hoja->pegado/2;
                            $totalDespacho3=$divisionPegado*$datos->cantidad_4;
                         }
                         else
                         {
                             if ($datos->pegado_migrado=='')
                                $divisionPegado=$presupuesto->costo_pegado/2;
                             else
                                $divisionPegado=$datos->pegado_migrado/2;
                             $totalDespacho3=$divisionPegado*$datos->cantidad_4;	 
                         }
                         
                         //*******************************************
                        $externos_produccion=0;
				if($fotomecanica->acabado_impresion_4=="17")
                                {
                                    $acabado_4="";
                                    $acabado_4Valor="";
                                    $acabado_4MedidaMasValorVenta="";
                                    $acabado_4Unitario="";
                                    $acabado_4UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_4Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_4);
                                    $acabado_4=$acabado_4Array->caracteristicas; // Nombre acabado
                                    $acabado_4UnidadVentaNombre=$acabado_4Array->unv; //Nombre unidad de venta
                                    $acabado_4Valor=$acabado_4Array->valor_venta; // ej: 52
                                    $acabado_4MedidaMasValorVenta=($tamano1*$tamano2*$acabado_4Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_4CostoFijo=$acabado_4Array->costo_fijo;	
                                    
                                    if ($acabado_4Array->unidad_de_venta == '1') //Metros
                                    {
                                        $costo_unitario4=$acabado_4MedidaMasValorVenta;
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_3);
                                        $cantidad_4=$datos->cantidad_3;
                                    }
                                    elseif ($acabado_4Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $costo_unitario4=$acabado_4Valor;
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }  
                                    elseif ($acabado_4Array->unidad_de_venta == '3') //tONELADA
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_3);
                                    }                                    
                                    elseif ($acabado_4Array->unidad_de_venta == '4') //caja de carton
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_3);
                                    }                                            
                                    elseif ($acabado_4Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($datos->cantidad_3*$acabado_4Valor);
                                        $cantidad_4=$datos->cantidad_3;
                                    }       
                                    elseif ($acabado_4Array->unidad_de_venta == '6') //cm2
                                    {
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $costo_unitario4=$acabado_4Valor;     
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }   
                                    elseif ($acabado_4Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario4=$acabado_4MedidaMasValorVenta;
                                        $precio_total_4=$acabado_4MedidaMasValorVenta*$datos->cantidad_3;
                                        $cantidad_4=$datos->cantidad_3;
                                    }
                                    elseif ($acabado_4Array->unidad_de_venta == '8') //cms
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_3);
                                    }           
                                    elseif ($acabado_4Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }     
                                    elseif ($acabado_4Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($acabado_4Valor*$datos->cantidad_3);
                                        $cantidad_4=$datos->cantidad_3;                                        
                                    }                                      
                                }
								
                                if($fotomecanica->acabado_impresion_5=="17")
                                {
                                    $acabado_5="";
                                    $acabado_5Valor="";
                                    $acabado_5MedidaMasValorVenta="";
                                    $acabado_5Unitario="";
                                    $acabado_5UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_5Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_5);
                                    $acabado_5=$acabado_5Array->caracteristicas;
                                    $acabado_5UnidadVentaNombre=$acabado_5Array->unv; //Nombre unidad de venta
                                    $acabado_5Valor=$acabado_5Array->valor_venta; // ej: 52
                                    $acabado_5MedidaMasValorVenta=($tamano1*$tamano2*$acabado_5Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_5CostoFijo=$acabado_5Array->costo_fijo;		
                                  if ($acabado_5Array->unidad_de_venta == '1') //mt2
                                    {
                                        $costo_unitario5=$acabado_5MedidaMasValorVenta;
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_3);                                      
                                        $cantidad_5=$datos->cantidad_3;
                                    }
                                    elseif ($acabado_5Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $costo_unitario5=$acabado_5Valor; 
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }    
                                    elseif ($acabado_5Array->unidad_de_venta == '3') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_3);
                                    }                                    
                                    elseif ($acabado_5Array->unidad_de_venta == '4') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_3);
                                    }                                            
                                    elseif ($acabado_5Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($datos->cantidad_3*$acabado_5Valor);
                                        $cantidad_5=$datos->cantidad_3;
                                    }       
                                    elseif ($acabado_5Array->unidad_de_venta == '6') //mt2
                                    {
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $costo_unitario5=$acabado_5Valor;
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }   
                                    elseif ($acabado_5Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario5=$acabado_5MedidaMasValorVenta;
                                        $precio_total_5=$acabado_5MedidaMasValorVenta*$datos->cantidad_3;
                                        $cantidad_5=$datos->cantidad_3;
                                    }
                                    elseif ($acabado_5Array->unidad_de_venta == '8') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_3);
                                    }           
                                    elseif ($acabado_5Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }   
                                    elseif ($acabado_5Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($acabado_5Valor*$datos->cantidad_3);
                                        $cantidad_5=$datos->cantidad_3;
                                    }                                      
                                }    
                                if($fotomecanica->acabado_impresion_6=="17")
                                {
                                    $acabado_6="";
                                    $acabado_6Valor="";
                                    $acabado_6MedidaMasValorVenta="";
                                    $acabado_6Unitario="";
                                    $acabado_6UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_6Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_6);
                                    $acabado_6=$acabado_6Array->caracteristicas;
                                    $acabado_6UnidadVentaNombre=$acabado_6Array->unv; //Nombre unidad de venta
                                    $acabado_6Valor=$acabado_6Array->valor_venta; // ej: 52
                                    $acabado_6MedidaMasValorVenta=($tamano1*$tamano2*$acabado_6Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_6CostoFijo=$acabado_6Array->costo_fijo;		
                                    if ($acabado_6Array->unidad_de_venta == '1') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_3);
                                    }
                                    elseif ($acabado_6Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $costo_unitario6=$acabado_6Valor; 
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    }  
                                    elseif ($acabado_6Array->unidad_de_venta == '3') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_3);
                                    }                                    
                                    elseif ($acabado_6Array->unidad_de_venta == '4') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_3);
                                    }                                            
                                    elseif ($acabado_6Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($datos->cantidad_3*$acabado_5Valor);
                                        $cantidad_6=$datos->cantidad_3;
                                    }       
                                    elseif ($acabado_6Array->unidad_de_venta == '6') //mt2
                                    {
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $costo_unitario6=$acabado_6Valor;
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    }   
                                    elseif ($acabado_6Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario6=$acabado_6MedidaMasValorVenta;
                                        $precio_total_6=$acabado_6MedidaMasValorVenta*$datos->cantidad_3;
                                        $cantidad_6=$datos->cantidad_3;
                                    }
                                    elseif ($acabado_6Array->unidad_de_venta == '8') //cms
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_3);
                                    }           
                                    elseif ($acabado_6Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    } 
                                    elseif ($acabado_6Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($acabado_6Valor*$datos->cantidad_3);
                                        $cantidad_6=$datos->cantidad_3;
                                    }                                      
									

                                }            
                        //*******************************************
              $externos_produccion3=$precio_total_4+$precio_total_5+$precio_total_6;
                        $externos_produccion=0;
				if($fotomecanica->acabado_impresion_4=="17")
                                {
                                    $acabado_4="";
                                    $acabado_4Valor="";
                                    $acabado_4MedidaMasValorVenta="";
                                    $acabado_4Unitario="";
                                    $acabado_4UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_4Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_4);
                                    $acabado_4=$acabado_4Array->caracteristicas; // Nombre acabado
                                    $acabado_4UnidadVentaNombre=$acabado_4Array->unv; //Nombre unidad de venta
                                    $acabado_4Valor=$acabado_4Array->valor_venta; // ej: 52
                                    $acabado_4MedidaMasValorVenta=($tamano1*$tamano2*$acabado_4Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_4CostoFijo=$acabado_4Array->costo_fijo;	
                                    
                                    if ($acabado_4Array->unidad_de_venta == '1') //Metros
                                    {
                                        $costo_unitario4=$acabado_4MedidaMasValorVenta;
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_4);
                                        $cantidad_4=$datos->cantidad_4;
                                    }
                                    elseif ($acabado_4Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $costo_unitario4=$acabado_4Valor;
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }  
                                    elseif ($acabado_4Array->unidad_de_venta == '3') //tONELADA
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_4);
                                    }                                    
                                    elseif ($acabado_4Array->unidad_de_venta == '4') //caja de carton
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_4);
                                    }                                            
                                    elseif ($acabado_4Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($datos->cantidad_3*$acabado_4Valor);
                                        $cantidad_4=$datos->cantidad_4;
                                    }       
                                    elseif ($acabado_4Array->unidad_de_venta == '6') //cm2
                                    {
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $costo_unitario4=$acabado_4Valor;     
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }   
                                    elseif ($acabado_4Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario4=$acabado_4MedidaMasValorVenta;
                                        $precio_total_4=$acabado_4MedidaMasValorVenta*$datos->cantidad_4;
                                        $cantidad_4=$datos->cantidad_4;
                                    }
                                    elseif ($acabado_4Array->unidad_de_venta == '8') //cms
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_4);
                                    }           
                                    elseif ($acabado_4Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }     
                                    elseif ($acabado_4Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($acabado_4Valor*$datos->cantidad_4);
                                        $cantidad_4=$datos->cantidad_4;                                        
                                    }                                      
                                }
								
                                if($fotomecanica->acabado_impresion_5=="17")
                                {
                                    $acabado_5="";
                                    $acabado_5Valor="";
                                    $acabado_5MedidaMasValorVenta="";
                                    $acabado_5Unitario="";
                                    $acabado_5UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_5Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_5);
                                    $acabado_5=$acabado_5Array->caracteristicas;
                                    $acabado_5UnidadVentaNombre=$acabado_5Array->unv; //Nombre unidad de venta
                                    $acabado_5Valor=$acabado_5Array->valor_venta; // ej: 52
                                    $acabado_5MedidaMasValorVenta=($tamano1*$tamano2*$acabado_5Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_5CostoFijo=$acabado_5Array->costo_fijo;		
                                  if ($acabado_5Array->unidad_de_venta == '1') //mt2
                                    {
                                        $costo_unitario5=$acabado_5MedidaMasValorVenta;
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_4);                                      
                                        $cantidad_5=$datos->cantidad_4;
                                    }
                                    elseif ($acabado_5Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $costo_unitario5=$acabado_5Valor; 
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }    
                                    elseif ($acabado_5Array->unidad_de_venta == '3') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_4);
                                    }                                    
                                    elseif ($acabado_5Array->unidad_de_venta == '4') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_4);
                                    }                                            
                                    elseif ($acabado_5Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($datos->cantidad_4*$acabado_5Valor);
                                        $cantidad_5=$datos->cantidad_4;
                                    }       
                                    elseif ($acabado_5Array->unidad_de_venta == '6') //mt2
                                    {
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $costo_unitario5=$acabado_5Valor;
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }   
                                    elseif ($acabado_5Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario5=$acabado_5MedidaMasValorVenta;
                                        $precio_total_5=$acabado_5MedidaMasValorVenta*$datos->cantidad_4;
                                        $cantidad_5=$datos->cantidad_4;
                                    }
                                    elseif ($acabado_5Array->unidad_de_venta == '8') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_4);
                                    }           
                                    elseif ($acabado_5Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }   
                                    elseif ($acabado_5Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($acabado_5Valor*$datos->cantidad_4);
                                        $cantidad_5=$datos->cantidad_4;
                                    }                                      
                                }    
                                if($fotomecanica->acabado_impresion_6=="17")
                                {
                                    $acabado_6="";
                                    $acabado_6Valor="";
                                    $acabado_6MedidaMasValorVenta="";
                                    $acabado_6Unitario="";
                                    $acabado_6UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_6Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_6);
                                    $acabado_6=$acabado_6Array->caracteristicas;
                                    $acabado_6UnidadVentaNombre=$acabado_6Array->unv; //Nombre unidad de venta
                                    $acabado_6Valor=$acabado_6Array->valor_venta; // ej: 52
                                    $acabado_6MedidaMasValorVenta=($tamano1*$tamano2*$acabado_6Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_6CostoFijo=$acabado_6Array->costo_fijo;		
                                    if ($acabado_6Array->unidad_de_venta == '1') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_4);
                                    }
                                    elseif ($acabado_6Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $costo_unitario6=$acabado_6Valor; 
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    }  
                                    elseif ($acabado_6Array->unidad_de_venta == '3') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_4);
                                    }                                    
                                    elseif ($acabado_6Array->unidad_de_venta == '4') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_4);
                                    }                                            
                                    elseif ($acabado_6Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($datos->cantidad_4*$acabado_5Valor);
                                        $cantidad_6=$datos->cantidad_4;
                                    }       
                                    elseif ($acabado_6Array->unidad_de_venta == '6') //mt2
                                    {
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $costo_unitario6=$acabado_6Valor;
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    }   
                                    elseif ($acabado_6Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario6=$acabado_6MedidaMasValorVenta;
                                        $precio_total_6=$acabado_6MedidaMasValorVenta*$datos->cantidad_4;
                                        $cantidad_6=$datos->cantidad_4;
                                    }
                                    elseif ($acabado_6Array->unidad_de_venta == '8') //cms
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_4);
                                    }           
                                    elseif ($acabado_6Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    } 
                                    elseif ($acabado_6Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($acabado_6Valor*$datos->cantidad_4);
                                        $cantidad_6=$datos->cantidad_4;
                                    }                                      
									

                                }            
                        //*******************************************
              $externos_produccion4=$precio_total_4+$precio_total_5+$precio_total_6;
                         //*******************************************
                        $externos_produccion=0;
				if($fotomecanica->acabado_impresion_4=="17")
                                {
                                    $acabado_4="";
                                    $acabado_4Valor="";
                                    $acabado_4MedidaMasValorVenta="";
                                    $acabado_4Unitario="";
                                    $acabado_4UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_4Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_4);
                                    $acabado_4=$acabado_4Array->caracteristicas; // Nombre acabado
                                    $acabado_4UnidadVentaNombre=$acabado_4Array->unv; //Nombre unidad de venta
                                    $acabado_4Valor=$acabado_4Array->valor_venta; // ej: 52
                                    $acabado_4MedidaMasValorVenta=($tamano1*$tamano2*$acabado_4Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_4CostoFijo=$acabado_4Array->costo_fijo;	
                                    
                                    if ($acabado_4Array->unidad_de_venta == '1') //Metros
                                    {
                                        $costo_unitario4=$acabado_4MedidaMasValorVenta;
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_2);
                                        $cantidad_4=$datos->cantidad_2;
                                    }
                                    elseif ($acabado_4Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $costo_unitario4=$acabado_4Valor;
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }  
                                    elseif ($acabado_4Array->unidad_de_venta == '3') //tONELADA
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_2);
                                    }                                    
                                    elseif ($acabado_4Array->unidad_de_venta == '4') //caja de carton
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_2);
                                    }                                            
                                    elseif ($acabado_4Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($datos->cantidad_2*$acabado_4Valor);
                                        $cantidad_4=$datos->cantidad_2;
                                    }       
                                    elseif ($acabado_4Array->unidad_de_venta == '6') //cm2
                                    {
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $costo_unitario4=$acabado_4Valor;     
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }   
                                    elseif ($acabado_4Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario4=$acabado_4MedidaMasValorVenta;
                                        $precio_total_4=$acabado_4MedidaMasValorVenta*$datos->cantidad_2;
                                        $cantidad_4=$datos->cantidad_2;
                                    }
                                    elseif ($acabado_4Array->unidad_de_venta == '8') //cms
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_2);
                                    }           
                                    elseif ($acabado_4Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }     
                                    elseif ($acabado_4Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($acabado_4Valor*$datos->cantidad_2);
                                        $cantidad_4=$datos->cantidad_2;                                        
                                    }                                      
                                }
								
                                if($fotomecanica->acabado_impresion_5=="17")
                                {
                                    $acabado_5="";
                                    $acabado_5Valor="";
                                    $acabado_5MedidaMasValorVenta="";
                                    $acabado_5Unitario="";
                                    $acabado_5UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_5Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_5);
                                    $acabado_5=$acabado_5Array->caracteristicas;
                                    $acabado_5UnidadVentaNombre=$acabado_5Array->unv; //Nombre unidad de venta
                                    $acabado_5Valor=$acabado_5Array->valor_venta; // ej: 52
                                    $acabado_5MedidaMasValorVenta=($tamano1*$tamano2*$acabado_5Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_5CostoFijo=$acabado_5Array->costo_fijo;		
                                  if ($acabado_5Array->unidad_de_venta == '1') //mt2
                                    {
                                        $costo_unitario5=$acabado_5MedidaMasValorVenta;
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_2);                                      
                                        $cantidad_5=$datos->cantidad_2;
                                    }
                                    elseif ($acabado_5Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $costo_unitario5=$acabado_5Valor; 
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }    
                                    elseif ($acabado_5Array->unidad_de_venta == '3') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_2);
                                    }                                    
                                    elseif ($acabado_5Array->unidad_de_venta == '4') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_2);
                                    }                                            
                                    elseif ($acabado_5Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($datos->cantidad_2*$acabado_5Valor);
                                        $cantidad_5=$datos->cantidad_2;
                                    }       
                                    elseif ($acabado_5Array->unidad_de_venta == '6') //mt2
                                    {
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $costo_unitario5=$acabado_5Valor;
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }   
                                    elseif ($acabado_5Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario5=$acabado_5MedidaMasValorVenta;
                                        $precio_total_5=$acabado_5MedidaMasValorVenta*$datos->cantidad_2;
                                        $cantidad_5=$datos->cantidad_2;
                                    }
                                    elseif ($acabado_5Array->unidad_de_venta == '8') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_2);
                                    }           
                                    elseif ($acabado_5Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }   
                                    elseif ($acabado_5Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($acabado_5Valor*$datos->cantidad_2);
                                        $cantidad_5=$datos->cantidad_2;
                                    }                                      
                                }    
                                if($fotomecanica->acabado_impresion_6=="17")
                                {
                                    $acabado_6="";
                                    $acabado_6Valor="";
                                    $acabado_6MedidaMasValorVenta="";
                                    $acabado_6Unitario="";
                                    $acabado_6UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_6Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_6);
                                    $acabado_6=$acabado_6Array->caracteristicas;
                                    $acabado_6UnidadVentaNombre=$acabado_6Array->unv; //Nombre unidad de venta
                                    $acabado_6Valor=$acabado_6Array->valor_venta; // ej: 52
                                    $acabado_6MedidaMasValorVenta=($tamano1*$tamano2*$acabado_6Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_6CostoFijo=$acabado_6Array->costo_fijo;		
                                    if ($acabado_6Array->unidad_de_venta == '1') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_2);
                                    }
                                    elseif ($acabado_6Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $costo_unitario6=$acabado_6Valor; 
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    }  
                                    elseif ($acabado_6Array->unidad_de_venta == '3') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_2);
                                    }                                    
                                    elseif ($acabado_6Array->unidad_de_venta == '4') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_2);
                                    }                                            
                                    elseif ($acabado_6Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($datos->cantidad_2*$acabado_5Valor);
                                        $cantidad_6=$datos->cantidad_2;
                                    }       
                                    elseif ($acabado_6Array->unidad_de_venta == '6') //mt2
                                    {
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $costo_unitario6=$acabado_6Valor;
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    }   
                                    elseif ($acabado_6Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario6=$acabado_6MedidaMasValorVenta;
                                        $precio_total_6=$acabado_6MedidaMasValorVenta*$datos->cantidad_2;
                                        $cantidad_6=$datos->cantidad_2;
                                    }
                                    elseif ($acabado_6Array->unidad_de_venta == '8') //cms
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_2);
                                    }           
                                    elseif ($acabado_6Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    } 
                                    elseif ($acabado_6Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($acabado_6Valor*$datos->cantidad_2);
                                        $cantidad_6=$datos->cantidad_2;
                                    }                                      
									

                                }            
                        //*******************************************
              $externos_produccion2=$precio_total_4+$precio_total_5+$precio_total_6;
                                            
            $tira3=((($datos->cantidad_2/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2)."<br>";
            $tira4=((($datos->cantidad_2/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
            $tirajetotal2=$tira3+$tira4."<br>";
            
            $tira5=((($datos->cantidad_3/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2)."<br>";
            $tira6=((($datos->cantidad_3/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
            $tirajetotal3=$tira5+$tira6."<br>";
            
            $tira7=((($datos->cantidad_4/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2)."<br>";
            $tira8=((($datos->cantidad_4/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
            $tirajetotal4=$tira7+$tira8."<br>";
            //exit();
            //valor corte para los 4
            $valorCorte2=(((($datos->cantidad_2/$ing->unidades_por_pliego)*1.04)+104)*4.5);
            $valorCorte3=(((($datos->cantidad_3/$ing->unidades_por_pliego)*1.04)+104)*4.5);
            $valorCorte4=(((($datos->cantidad_4/$ing->unidades_por_pliego)*1.04)+104)*4.5);
            
           $costoOnda2=(((($datos->cantidad_2/$ing->unidades_por_pliego)*1.04)+104))."<br>";
           $costoOnda3=(((($datos->cantidad_3/$ing->unidades_por_pliego)*1.04)+104))."<br>";
           $costoOnda4=(((($datos->cantidad_4/$ing->unidades_por_pliego)*1.04)+104))."<br>";
           
            if($fotomecanica->estan_los_moldes == 'NO LLEVA')
	    {
            $variableTroquelado=0;
            $totalTroquelado=0;
            }else
            {
            $variableTroquelado=$this->variables_cotizador_model->getVariablesCotizadorPorId(11);
            $totalTroquelado2=($costoOnda2*$variableTroquelado->precio)*1.5;	
            }     
            if($fotomecanica->estan_los_moldes == 'NO LLEVA')
	    {
            $variableTroquelado=0;
            $totalTroquelado=0;
            }else
            {
            $variableTroquelado=$this->variables_cotizador_model->getVariablesCotizadorPorId(11);
            $totalTroquelado3=($costoOnda3*$variableTroquelado->precio)*1.5;	
            }     
            if($fotomecanica->estan_los_moldes == 'NO LLEVA')
	    {
            $variableTroquelado=0;
            $totalTroquelado=0;
            }else
            {
            $variableTroquelado=$this->variables_cotizador_model->getVariablesCotizadorPorId(11);
            $totalTroquelado4=($costoOnda4*$variableTroquelado->precio)*1.5;	
            }     
           // valor del emplacado 
           $variableEmplacado=$this->variables_cotizador_model->getVariablesCotizadorPorId(8);
           $valorEmplacadado=($variableEmplacado->precio*$tamano1*$tamano2)/10000;
           $totalEmplacado2=$valorEmplacadado*$costoOnda2."<br>";
           $totalEmplacado3=$valorEmplacadado*$costoOnda3."<br>";
           $totalEmplacado4=$valorEmplacadado*$costoOnda4."<br>";
                            $dos=($datos->cantidad_2/$ing->unidades_por_pliego)+$sum2."<br />";
                            $tres=($datos->cantidad_3/$ing->unidades_por_pliego)+$sum3."<br />";
                            $cuatro=($datos->cantidad_4/$ing->unidades_por_pliego)+$sum4."<br />";
                            
                            $valorPlacaKilo2=(($dos*$tamano1*$tamano2*$tapaGramaje)/10000000)."<br />";
                            $valorPlacaKilo3=(($tres*$tamano1*$tamano2*$tapaGramaje)/10000000)."<br />";
                            $valorPlacaKilo4=(($cuatro*$tamano1*$tamano2*$tapaGramaje)/10000000)."<br />";
                            
                            $totalPlacaKilo2=$valorPlacaKilo2*$materialidad_1->precio."<br />";
                            $totalPlacaKilo3=$valorPlacaKilo3*$materialidad_1->precio."<br />";
                            $totalPlacaKilo4=$valorPlacaKilo4*$materialidad_1->precio."<br />";
                            
                            $v2= number_format((($datos->cantidad_2/$ing->unidades_por_pliego)*1.04)+104,0,'','.');
                            $v3= number_format((($datos->cantidad_3/$ing->unidades_por_pliego)*1.04)+104,0,'','.');
                            $v4= number_format((($datos->cantidad_4/$ing->unidades_por_pliego)*1.04)+104,0,'','.');
                            
                            $OndaKilo2=number_format((($v2*$tamano1*$tamano2*$GramosMetroCuadrado)/10000),0,'','.')."<br />";
                            $OndaKilo3=number_format((($v3*$tamano1*$tamano2*$GramosMetroCuadrado)/10000),0,'','.')."<br />";
                            $OndaKilo4=number_format((($v4*$tamano1*$tamano2*$GramosMetroCuadrado)/10000),0,'','.')."<br />";
                            
                            $vt2=number_format((($v2*$tamano1*$tamano2*$GramosMetroCuadrado)/10000)*$costo_kilo,0,'','.')."<br />";
                            $vt3=number_format((($v3*$tamano1*$tamano2*$GramosMetroCuadrado)/10000)*$costo_kilo,0,'','.')."<br />";
                            $vt4=number_format((($v4*$tamano1*$tamano2*$GramosMetroCuadrado)/10000)*$costo_kilo,0,'','.')."<br />";
                            //echo number_format($totalPlacaKilo2,0,'','.')."<br>";
                            
                            $totalDefi1=$totalPlacaKilo2+((($v2*$tamano1*$tamano2*$GramosMetroCuadrado)/10000)*$costo_kilo);
                            $totalDefi2=$totalPlacaKilo3+((($v3*$tamano1*$tamano2*$GramosMetroCuadrado)/10000)*$costo_kilo);
                            $totalDefi3=$totalPlacaKilo4+((($v4*$tamano1*$tamano2*$GramosMetroCuadrado)/10000)*$costo_kilo);
                            
                            
                            
                            $variableDesgajado=$this->variables_cotizador_model->getVariablesCotizadorPorId(12);
                            $totalDesgajado2=$ing->piezas_totales_en_el_pliego*$variableDesgajado->precio*1.5*$costoOnda2;
                            $totalDesgajado3=$ing->piezas_totales_en_el_pliego*$variableDesgajado->precio*1.5*$costoOnda3;
                            $totalDesgajado4=$ing->piezas_totales_en_el_pliego*$variableDesgajado->precio*1.5*$costoOnda4;
                            $TotalPiezasAdicionales2=$datos->cantidad_2*$piezaAdacionalValor1;
                            $TotalPiezasAdicionales3=$datos->cantidad_3*$piezaAdacionalValor1;
                            $TotalPiezasAdicionales4=$datos->cantidad_4*$piezaAdacionalValor1;
                            //echo $GramosMetroCuadrado."<br>";
                            //echo $tamano2."<br>";
                            //echo $tamano1."<br>";
                            //echo $v2."<br>";
                            //echo $totalPlacaKilo."<br>";
                            //echo $OndaKilo2."<br>";
                             if(sizeof($hoja)==0) { 
                              $margen= $datos->margen_migrado;
				 } else {if($hoja->margen == null){$margen=15;}
                                 else{
                                 $margen=$hoja->margen;}
			         }  
                              //$margen."<br>";
                            // $totalPreImpresion."<br>";
                            //$totalDefi1=$totalPlacaKilo2+((($v2*$tamano1*$tamano2*$GramosMetroCuadrado)/10000)*$costo_kilo)."<br>";
                            $totalProduccion2=$costosporlacado2+$complemento+$valorCorte2+$totalEmplacado2+$totalMontajeMolde+$totalTroquelado2+$totalPegado+$totalDespacho+$tirajetotal2+$moldeTroquel+$totalDesgajado2+$externos_produccion2+$otrosCaucho + $TotalPiezasAdicionales2 + $valor_extra + $valor_bv_maquina + $valor_acepeta_exce."<br>";
                            $totalProduccion3=$costosporlacado3+$complemento+$valorCorte3+$totalEmplacado3+$totalMontajeMolde+$totalTroquelado3+$totalPegado2+$totalDespacho2+$tirajetotal3+$moldeTroquel+$totalDesgajado3+$externos_produccion3+$otrosCaucho + $TotalPiezasAdicionales3 + $valor_extra + $valor_bv_maquina + $valor_acepeta_exce."<br>";
                            $totalProduccion4=$costosporlacado4+$complemento+$valorCorte4+$totalEmplacado4+$totalMontajeMolde+$totalTroquelado4+$totalPegado3+$totalDespacho3+$tirajetotal4+$moldeTroquel+$totalDesgajado4+$externos_produccion4+$otrosCaucho + $TotalPiezasAdicionales4 + $valor_extra + $valor_bv_maquina + $valor_acepeta_exce."<br>";
                            
//                            echo $complemento."<br>";
                            //echo $totalProduccion2+$totalDefi1+$totalPreImpresion."<br>";
//                            echo $valorCorte2."<br>";
//                            echo $totalEmplacado2."<br>";
//                            echo $totalMontajeMolde."<br>";
//                            echo $totalTroquelado2."<br>";
//                            echo $totalPegado."<br>";
//                            echo $totalDespacho."<br>";
//                            echo $tirajetotal2."<br>";
//                            echo $moldeTroquel."<br>";
//                            echo $totalDesgajado2."<br>";
//                            echo $externos_produccion2."<br>";
//                            echo $otrosCaucho."<br>";
//                            echo $TotalPiezasAdicionales2."<br>";
//                            echo $valor_extra."<br>";
//                            echo $valor_bv_maquina."<br>";
//                            echo $valor_acepeta_exce."<br>";
                            ?>
                        <table id="tabla_detalle">
                            <tr>
                                <td class="celda_3">CANTIDAD 2</td>
                                <td class="celda_3"><?php if($datos->cantidad_2 == 1){ echo 0;}else{echo number_format($datos->cantidad_2,0,"",".");}?> <a href="<?php echo base_url()?>hoja/cantidad2/<?php echo $id?>/2" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a></td>
                                <td class="celda_3">CANTIDAD 3</td>
                                <td class="celda_3"><?php if($datos->cantidad_3 == 1){ echo 0;}else{echo number_format($datos->cantidad_3,0,"",".");}?> <a href="<?php echo base_url()?>hoja/cantidad2/<?php echo $id?>/3" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a></td>
                                <td class="celda_3">CANTIDAD 4</td>
                                <td class="celda_3"><?php if($datos->cantidad_4 == 1){ echo 0;}else{echo number_format($datos->cantidad_4,0,"",".");}?> <a href="<?php echo base_url()?>hoja/cantidad2/<?php echo $id?>/4" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a></td>
                            </tr>
							<?php 
							 
							?>
							
                            <tr>
                                <td class="celda_3">VALOR FINAL</td>
                                <td class="celda_3"><?php if($datos->cantidad_2 == 1){ echo 0;}else{
                                echo number_format(((((($totalProduccion2+$totalDefi1+$totalPreImpresion)*0.085)+(($totalProduccion2+$totalDefi1+$totalPreImpresion)*0.085)+($totalProduccion2+$totalDefi1+$totalPreImpresion))/((100-$margen)/100))/$datos->cantidad_2),0,'','.');}?></td>
                                <td class="celda_3">VALOR FINAL</td>
                                <td class="celda_3"><?php if($datos->cantidad_3 == 1){ echo 0;}else{
                                echo number_format(((((($totalProduccion3+$totalDefi2+$totalPreImpresion)*0.085)+(($totalProduccion3+$totalDefi2+$totalPreImpresion)*0.085)+($totalProduccion3+$totalDefi2+$totalPreImpresion))/((100-$margen)/100))/$datos->cantidad_3),0,'','.');}?></td>
                                <td class="celda_3">VALOR FINAL</td>
                                <td class="celda_3"><?php if($datos->cantidad_4 == 1){ echo 0;}else{
                                echo number_format(((((($totalProduccion4+$totalDefi3+$totalPreImpresion)*0.085)+(($totalProduccion4+$totalDefi3+$totalPreImpresion)*0.085)+($totalProduccion4+$totalDefi3+$totalPreImpresion))/((100-$margen)/100))/$datos->cantidad_4),0,'','.');}?></td>
                            </tr>
                            <?php
				if(sizeof($hoja)==0)
                                {
                                    $valorEmpresa2=number_format($valorFinanciado2,0,'','.');
                                    $valorEmpresa3=number_format($valorFinanciado3,0,'','.');
                                    $valorEmpresa4=number_format($valorFinanciado4,0,'','.');
                                }else
                                {
                                    $valorEmpresa2=$hoja->valor_empresa_2;
                                    $valorEmpresa3=$hoja->valor_empresa_3;
                                    $valorEmpresa4=$hoja->valor_empresa_4;
                                }
								

								if($hoja->valor_empresa_2 == 0)
                                {
                                    $valorEmpresa_2=$valorFinanciado2;  
									
									$arregloVEmpresa=array
									(
										"valor_empresa_2"=>$valorEmpresa_2,
									);
									
									$this->db->where('id', $hoja->id);
									$this->db->update("hoja_de_costos_datos",$arregloVEmpresa);
                                }
								
								if($hoja->valor_empresa_3 ==0)
                                {                                    
                                    $valorEmpresa_3=$valorFinanciado3;  
									
									$arregloVEmpresa=array
									(
										"valor_empresa_3"=>$valorEmpresa_3,
									);
									
									$this->db->where('id', $hoja->id);
									$this->db->update("hoja_de_costos_datos",$arregloVEmpresa);                                  
                                }
								
								if($hoja->valor_empresa_4 ==0)
                                {
                                    $valorEmpresa_4=$valorFinanciado4;  
									
									$arregloVEmpresa=array
									(
										"valor_empresa_4"=>$valorEmpresa_4,
									);
									
									$this->db->where('id', $hoja->id);
									$this->db->update("hoja_de_costos_datos",$arregloVEmpresa);   
                                }
								
								
                            ?>
                            
							<?php
							
							
							?>
							
                            <tr>
                                <td class="celda_3">VALOR FINANCIERO 2</td>
                                <td class="celda_3">
                                <?php echo number_format((((($vcostoFinanciero->precio/30)*30)+100)/100)*((((($totalProduccion2+$totalDefi1+$totalPreImpresion)*0.085)+(($totalProduccion2+$totalDefi1+$totalPreImpresion)*0.085)+($totalProduccion2+$totalDefi1+$totalPreImpresion))/((100-$margen)/100))/$datos->cantidad_2),0,'','.') ?>
                                </td>
                                <td class="celda_3">VALOR FINANCIERO 3</td>
                                <td class="celda_3">
                                <?php echo number_format((((($vcostoFinanciero->precio/30)*30)+100)/100)*((((($totalProduccion3+$totalDefi2+$totalPreImpresion)*0.085)+(($totalProduccion3+$totalDefi2+$totalPreImpresion)*0.085)+($totalProduccion3+$totalDefi2+$totalPreImpresion))/((100-$margen)/100))/$datos->cantidad_3),0,'','.') ?>
                                </td>
                                <td class="celda_3">VALOR FINANCIERO 4</td>
                                <td class="celda_3">
                                <?php echo number_format((((($vcostoFinanciero->precio/30)*30)+100)/100)*((((($totalProduccion4+$totalDefi3+$totalPreImpresion)*0.085)+(($totalProduccion4+$totalDefi3+$totalPreImpresion)*0.085)+($totalProduccion4+$totalDefi3+$totalPreImpresion))/((100-$margen)/100))/$datos->cantidad_4),0,'','.') ?>
                                </td>
                            </tr>
                            <?php
                            $vfinanciero2=number_format((((($vcostoFinanciero->precio/30)*30)+100)/100)*((((($totalProduccion2+$totalDefi1+$totalPreImpresion)*0.085)+(($totalProduccion2+$totalDefi1+$totalPreImpresion)*0.085)+($totalProduccion2+$totalDefi1+$totalPreImpresion))/((100-$margen)/100))/$datos->cantidad_2),0,'','.');
                            $vfinanciero3=number_format((((($vcostoFinanciero->precio/30)*30)+100)/100)*((((($totalProduccion3+$totalDefi2+$totalPreImpresion)*0.085)+(($totalProduccion3+$totalDefi2+$totalPreImpresion)*0.085)+($totalProduccion3+$totalDefi2+$totalPreImpresion))/((100-$margen)/100))/$datos->cantidad_3),0,'','.');
                            $vfinanciero4=number_format((((($vcostoFinanciero->precio/30)*30)+100)/100)*((((($totalProduccion4+$totalDefi3+$totalPreImpresion)*0.085)+(($totalProduccion4+$totalDefi3+$totalPreImpresion)*0.085)+($totalProduccion4+$totalDefi3+$totalPreImpresion))/((100-$margen)/100))/$datos->cantidad_4),0,'','.');
                            ?>
                            <tr>
                                <td class="celda_3">VALOR EMPRESA 2</td>
                                <td class="celda_3"><?php if(sizeof($hoja)==0){if($datos->cantidad_2 == 1){echo 0;}else{if( $valorEmpresa2 == 0){echo number_format($valorFinanciado2,0,'','.');}else{echo $vfinanciero2;}}}else{echo number_format($hoja->valor_empresa_2,0,'','.');}?> <a href="<?php echo base_url()?>hoja/valor_empresa_2/<?php echo $id?>/2" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a></td>
                                <td class="celda_3">VALOR EMPRESA 3</td>
                                <td class="celda_3"><?php if(sizeof($hoja)==0){if($datos->cantidad_3 == 1){echo 0;}else{if( $valorEmpresa3 == 0){echo number_format($valorFinanciado3,0,'','.');}else{echo $vfinanciero3;}}}else{echo number_format($hoja->valor_empresa_3,0,'','.');}?> <a href="<?php echo base_url()?>hoja/valor_empresa_2/<?php echo $id?>/3" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a></td>
                                <td class="celda_3">VALOR EMPRESA 4</td>
                                <td class="celda_3"><?php if(sizeof($hoja)==0){if($datos->cantidad_4 == 1){echo 0;}else{if( $valorEmpresa4 == 0){echo number_format($valorFinanciado4,0,'','.');}else{echo $vfinanciero4;}}}else{echo number_format($hoja->valor_empresa_4,0,'','.');}?> <a href="<?php echo base_url()?>hoja/valor_empresa_2/<?php echo $id?>/4" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a></td>
								 
                            </tr>
                            <input type="hidden" name="valor_empresa_2" value="<?php if($datos->cantidad_2 == 1){
                                echo 0;
                            }
                            else{
                                    if( $valorEmpresa2 == 0){
                                        echo str_replace ( ".", "",$valorFinanciado2);
                                    }else{
                                        echo str_replace ( ".", "",$vfinanciero2);
                                    }
                                }?>" />
                            <input type="hidden" name="valor_empresa_3" value="<?php if($datos->cantidad_3 == 1){
                                echo 0;
                            }
                            else{
                                    if( $valorEmpresa3 == 0){
                                        echo str_replace ( ".", "",$valorFinanciado3);
                                    }else{
                                        echo str_replace ( ".", "",$vfinanciero3);
                                    }
                                }?>" />
                            <input type="hidden" name="valor_empresa_4" value="<?php if($datos->cantidad_4 == 1){
                                echo 0;
                            }
                            else{
                                    if( $valorEmpresa4 == 0){
                                        echo str_replace ( ".", "",$valorFinanciado4);
                                    }else{
                                        echo str_replace ( ".", "",$vfinanciero4);
                                    }
                                }?>" />
<!--                            <input type="hidden" name="valor_empresa_2" value="<?php// echo str_replace ( '.', '', $valorEmpresa2);?>" />
                            <input type="hidden" name="valor_empresa_3" value="<?php// echo str_replace ( '.', '', $valorEmpresa3);?>" />
                            <input type="hidden" name="valor_empresa_4" value="<?php// echo str_replace ( '.', '', $valorEmpresa4);?>" />-->
                        </table>
                        <div class="separador_10">&nbsp;</div>
                        <table id="tabla_detalle">
						
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">MATERIAL</td>
                                <td class="celda_3">GRAMAJE</td>
                                <td class="celda_3">TOTAL PLIEGOS</td>
                                <td class="celda_3"></td>
                                <td class="celda_3">TOTAL KILOS</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3"><?php echo $fotomecanica->materialidad_datos_tecnicos;?></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"></td>
                                <td class="celda_3"></td>
                                <td class="celda_3"></td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
							<?php
									if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
										{
							?>				
											
							<tr>
                                <td class="celda_3">TAPA</td>
                                <td class="celda_3"><?php echo $tapaNombre?> (<?php echo number_format($tapaPrecio,0,'','.')?>)</td>
                                <td class="celda_3"><?php echo number_format($costoPlacaKilo,0,'','.') ?></td>
                                <td class="celda_3"></td>
                                <td class="celda_3"><?php echo number_format($valorPlacaKilo,0,'','.');?></td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">Tapa (Respaldo)</td>
                                <td class="celda_3"><?php echo $tapaNombre2?> (<?php echo number_format($tapaPrecio2,0,'','.')?>)</td>
                                <td class="celda_3"><?php echo number_format($costoPlacaKilo2,0,'','.') ?></td>
                                <td class="celda_3"></td>
                                <td class="celda_3"><?php echo number_format($valorPlacaKilo2,0,'','.');?></td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3"></td>
                                <td class="celda_3"></td>
                                <td class="celda_3"></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"></td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>				
											
							<?php				
				}else{

                                    if($fotomecanica->materialidad_datos_tecnicos == 'Corrugado')
                                    {

                                        $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(25);
                                    }
                                    if($fotomecanica->materialidad_datos_tecnicos == 'Microcorrugado'){
                                    
                                        $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);	
                                    }			
                                    if($fotomecanica->materialidad_datos_tecnicos == 'Indefinido'){

                                        $variable_cotizador=$this->variables_cotizador_model->getVariablesCotizadorPorId(24);	
                                    }	                                    
//                                    exit($fotomecanica->materialidad_datos_tecnicos."aquiii");       
                                    if (($datos->cantidad_1>0) and ($ing->unidades_por_pliego>0))
                                        $cantidad_cajas = ($datos->cantidad_1 / $ing->unidades_por_pliego) + 104;                                    
                                    else $cantidad_cajas = 104;                                    
//                                    echo "cantidad_cajas = (".$datos->cantidad_1." / ".$ing->unidades_por_pliego.") + 104";
//                                    echo   "</br>kilosOnda =  (".$tamano1." * ".$tamano2." * <".$ondaGramaje."> * ".$cantidad_cajas." * ((".$variable_cotizador->precio." * 10 + 1000)/1000)) / 10000000";
                                    

                                    $kilosOnda =  ($tamano1 * $tamano2 * $ondaGramaje * $cantidad_cajas * (($variable_cotizador->precio * 10 + 1000)/1000)) / 10000000;
                                    $kilosLiner =  ($tamano1 * $tamano2 * $linerGramaje * $cantidad_cajas ) / 10000000;				
//                                    echo $kilosLiner ."=  (".$tamano1." * ".$tamano2." * ".$linerGramaje." * ".$cantidad_cajas." ) / 10000000";
                                    if(sizeof($hoja)>=1)
                                    {
                                        $arreglokilo2=array
                                        (
                                            "kilos_onda"=>$kilosOnda,
                                        );
                               
                                        $this->db->where('id', $hoja->id);
                                        $this->db->update("hoja_de_costos_datos",$arreglokilo2);
                                      

                                        $arreglokilo3=array
                                        (
                                            "kilos_liner"=>$kilosLiner,
                                        );
                                        $this->db->where('id', $hoja->id);
                                        $this->db->update("hoja_de_costos_datos",$arreglokilo3);
//                                        echo $hoja->id."---jaime----";
//                                        exit(print_r($arreglokilo2));                                           
                                    }
                                    ?>				
										
										
										
							<tr>
                                <td class="celda_3">TAPA</td>
                                <td class="celda_3"><?php echo $tapaNombre?> (<?php echo number_format($tapaPrecio,0,'','.')?>)</td>
                                <td class="celda_3">pliego_tapa</td>
                                <td class="celda_3"></td>
                                <td class="celda_3"><?php echo number_format($valorPlacaKilo,0,'','.');?></td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">ONDA</td>
                                <td class="celda_3"><?php echo $ondaNombre?> (<?php echo number_format($ondaPrecio,0,'','.')?>)</td>
                                <td class="celda_3">pliego_onda</td>
                                <td class="celda_3"></td>
                                <td class="celda_3"><?php echo number_format($kilosOnda,0,'','.');?></td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">LINER</td>
                                <td class="celda_3"><?php echo $linerNombre?> (<?php echo number_format($linerPrecio,0,'','.')?>)</td>
                                <td class="celda_3">pliego_liner</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo number_format($kilosLiner,0,'','.');?></td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>	
							<?php				
										}
							?>
                          
							<?php
									if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
										{
							?>	
							<tr>
                                <td class="celda_3">FECHA TAPA: <?php echo fecha_con_slash($tapaFecha)?></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">FECHA Tapa (Respaldo): <?php echo fecha_con_slash($tapaFecha2)?></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3"></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"></td>
                                <td class="celda_3"></td>
                            </tr>

							<?php
										}else{
							?>											
                            <tr>
                                <td class="celda_3">FECHA TAPA: <?php echo fecha_con_slash($tapaFecha)?></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">FECHA ONDA: <?php echo fecha_con_slash($ondaFecha)?></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_3">FECHA LINER: <?php echo fecha_con_slash($linerFecha)?></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">240</td>
                                <td class="celda_3">449.71</td>
                            </tr>
							
						<?php
						}
                                                
                                                //***************ehndz********************
                                                
                                                 if($totalTrabajosInternos=='No'){$totalTrabajosInternos=0;}else{$totalTrabajosInternos=$totalTrabajosInternos*50;}
                                                 if($totalTrabajosExternos=='No'){$totalTrabajosExternos="No";}else{$cantidadTrabajosExternos=$totalTrabajosExternos/50;}
                                                 //***************ehndz********************
                                                 //echo "<h1>".$totalTrabajosExternos."</h1>";exit();
						?>		
                        </table>    
                        <div class="separador_20"></div>
                        <table id="tabla_detalle">
                            <tr>
                                <td class="celda_2">
                                   <!--
 CANTIDAD 0 sss: 3.000 TOTAL $400.247
                                    <br />
                                    CANTIDAD 1 : 3.000 TOTAL $393.782
                                    <br />
                                    CANTIDAD 2 : 3.000 TOTAL
                                    <br />
                                    CANTIDAD 3 : 3.000 TOTAL
									
									
-->    
                                </td>
                                <td class="celda_1">&nbsp;</td>
                                <td class="celda_60 valign_top" rowspan="5">
                                    <!--mermas-->                          
                                    <table id="tabla_produccion">
                                        <tr>
                                            <td colspan="4">Tabla de Patrón de MERMAS Microonda TIPO E + Tapa por <?php echo $datos->cantidad_1; ?> = <?php echo ($datos->cantidad_1 / $ing->unidades_por_pliego); ?> Pliegos -- Total Colores <?php echo ($fotomecanica->colores); ?> Barniz: <?php echo ($fotomecanica->fot_lleva_barniz); ?>
                                            Trabajos Externos: <?php echo $cantidadTrabajosExternos; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Imprenta</td>
                                            <!--<td>Ultra</td>-->
                                            <td>Roland:800</td>
                                            <td>Roland:800</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>Color 1-2-3</td>
                                            <td>400</td>
                                            <td>400</td>
                                            <td>&nbsp;</td>
                                            <td><?php echo $color1?></td>
                                        </tr>
                                        <tr>
                                            <td>Color &gt; 3</td>
                                            <td><?php if($datos->vb_maquina == 'SI' or $datos->acepta_excedentes == 'NO'){echo '150';}else{echo '100';}?></td>
                                            <td><?php if($datos->vb_maquina == 'SI' or $datos->acepta_excedentes == 'NO'){echo '150';}else{echo '100';}?></td>
                                            <td>* Color</td>
                                            <td><?php echo $color2?></td>
                                        </tr>
                                        <tr>
                                            <td>Cantidad</td>
                                            <td>100</td>
                                            <td>100</td>
                                            <td>Cantidad &gt; 5.000 * c/5.000</td>
                                            <td><?php echo $can1?></td>
                                        </tr>
<!--                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>050</td>
                                            <td>050</td>
                                            <td>Cantidad &gt; 5.000 * c/5.000</td>
                                            <td><?php// echo $can2?></td>
                                        </tr>-->
                                        <tr>
                                            <td>Barniz</td>
                                            <td>100</td>
                                            <td>100</td>
                                            <td>Primeros 1.000</td>
                                            <td><?php echo $bar1 ?></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>010</td>
                                            <td>010</td>
                                            <td>por cada 1.000 extra</td>
                                            <td><?php echo $bar2?></td>
                                        </tr>
<!--                                        <tr>
                                            <td>Laca</td>
                                            <td>025</td>
                                            <td>025</td>
                                            <td>una sola vez</td>
                                            <td><?php //echo $laca?></td>
                                        </tr>
                                        <tr>
                                            <td>Folia</td>
                                            <td>025</td>
                                            <td>025</td>
                                            <td>una sola vez</td>
                                            <td><?php// echo $folia?></td>
                                        </tr>
                                        <tr>
                                            <td>Trabajos Internos</td>
                                            <td>050</td>
                                            <td>050</td>
                                            <td>una sola vez</td>
                                            <td><?php //echo $termolaminado?></td>
                                            <td><?php //echo $totalTrabajosInternos?></td>
                                        </tr>-->
                                        <tr>
                                            <td>Trabajo externo</td>
                                            <td>050</td>
                                            <td>050</td>
                                            <td>una sola vez</td>					
                                            <td><?php echo $externo?></td>
                                        </tr>
                                        <tr>
                                            <td>Micro/Micro</td>
                                            <td>030</td>
                                            <td>030</td>
                                            <td>una sola vez</td>
                                            <td><?php echo $micromicro?></td>
                                        </tr>
                                        <tr>
                                            <td>Cart/Cart</td>
                                            <td>030</td>
                                            <td>030</td>
                                            <td>una sola vez</td>
                                            <td><?php echo $cartulina?></td>
                                        </tr>
                                        <tr>
                                            <td>Tamaños Normales</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>Emplacado</td>
                                            <td>015</td>
                                            <td>015</td>
                                            <td>por cada 1.000</td>
                                            <td><?php echo $emplacado?></td>
                                        </tr>
                                        <tr>
                                            <td>Troquelado</td>
                                            <td>010</td>
                                            <td>010</td>
                                            <td>por cada 1.000</td>
                                            <td><?php echo $troquelado?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"><hr class="hr_punteada_corto" /></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td><?php echo number_format($sum,0,'','.')?></td>
                                        </tr>
                                    </table>
                                    <!--/mermas-->
                                </td>
                            </tr>
                            <tr>
                                <td class="celda_2">&nbsp;</td>
                                <td class="celda_1">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_2">&nbsp;</td>
                                <td class="celda_1">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_2"></td>
                                <td class="celda_1">&nbsp;</td>
                            </tr>
                        </table>
                        <div class="separador_20"></div>
                        <table id="tabla_detalle">
                            <tr>
                                <td class="celda_2">
                                   <!--
 CANTIDAD 0 sss: 3.000 TOTAL $400.247
                                    <br />
                                    CANTIDAD 1 : 3.000 TOTAL $393.782
                                    <br />
                                    CANTIDAD 2 : 3.000 TOTAL
                                    <br />
                                    CANTIDAD 3 : 3.000 TOTAL
									
									
-->    
                                </td>
                                <td class="celda_1">&nbsp;</td>
                                <td class="celda_60 valign_top" rowspan="5">
                                    <!--mermas-->
                                    <table id="tabla_produccion">
                                        <tr>
                                            <td colspan="4">Tabla de Patrón de MERMAS Microonda TIPO E + Tapa por <?php echo $datos->cantidad_2; ?> = <?php echo ($datos->cantidad_2 / $ing->unidades_por_pliego); ?> Pliegos -- Total Colores <?php echo ($fotomecanica->colores); ?> Barniz: <?php echo ($fotomecanica->fot_lleva_barniz); ?>
                                            Trabajos Externos: <?php echo $cantidadTrabajosExternos; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Imprenta</td>
                                            <!--<td>Ultra</td>-->
                                            <td>Roland:800</td>
                                            <td>Roland:800</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>Color 1-2-3</td>
                                            <td>400</td>
                                            <td>400</td>
                                            <td>&nbsp;</td>
                                            <td><?php echo $color1?></td>
                                        </tr>
                                        <tr>
                                            <td>Color &gt; 3</td>
                                            <td><?php if($datos->vb_maquina == 'SI' or $datos->acepta_excedentes == 'NO'){echo '150';}else{echo '100';}?></td>
                                            <td><?php if($datos->vb_maquina == 'SI' or $datos->acepta_excedentes == 'NO'){echo '150';}else{echo '100';}?></td>
                                            <td>* Color</td>
                                            <td><?php echo $color2?></td>
                                        </tr>
                                        <tr>
                                            <td>Cantidad</td>
                                            <td>100</td>
                                            <td>100</td>
                                            <td>Cantidad &gt; 5.000 * c/5.000</td>
                                            <td><?php echo $can3 ?></td>
                                        </tr>
<!--                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>050</td>
                                            <td>050</td>
                                            <td>Cantidad &gt; 5.000 * c/5.000</td>
                                            <td><?php// echo $can2?></td>
                                        </tr>-->
                                        <tr>
                                            <td>Barniz</td>
                                            <td>100</td>
                                            <td>100</td>
                                            <td>Primeros 1.000</td>
                                            <td><?php echo $bar3 ?></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>010</td>
                                            <td>010</td>
                                            <td>por cada 1.000 extra</td>
                                            <td><?php echo $bar4?></td>
                                        </tr>
<!--                                        <tr>
                                            <td>Laca</td>
                                            <td>025</td>
                                            <td>025</td>
                                            <td>una sola vez</td>
                                            <td><?php //echo $laca?></td>
                                        </tr>
                                        <tr>
                                            <td>Folia</td>
                                            <td>025</td>
                                            <td>025</td>
                                            <td>una sola vez</td>
                                            <td><?php// echo $folia?></td>
                                        </tr>
                                        <tr>
                                            <td>Trabajos Internos</td>
                                            <td>050</td>
                                            <td>050</td>
                                            <td>una sola vez</td>
                                            <td><?php //echo $termolaminado?></td>
                                            <td><?php //echo $totalTrabajosInternos?></td>
                                        </tr>-->
                                        <tr>
                                            <td>Trabajo externo</td>
                                            <td>050</td>
                                            <td>050</td>
                                            <td>una sola vez</td>					
                                            <td><?php echo $externo?></td>
                                        </tr>
                                        <tr>
                                            <td>Micro/Micro</td>
                                            <td>030</td>
                                            <td>030</td>
                                            <td>una sola vez</td>
                                            <td><?php echo $micromicro?></td>
                                        </tr>
                                        <tr>
                                            <td>Cart/Cart</td>
                                            <td>030</td>
                                            <td>030</td>
                                            <td>una sola vez</td>
                                            <td><?php echo $cartulina?></td>
                                        </tr>
                                        <tr>
                                            <td>Tamaños Normales</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>Emplacado</td>
                                            <td>015</td>
                                            <td>015</td>
                                            <td>por cada 1.000</td>
                                            <td><?php echo $emplacado2?></td>
                                        </tr>
                                        <tr>
                                            <td>Troquelado</td>
                                            <td>010</td>
                                            <td>010</td>
                                            <td>por cada 1.000</td>
                                            <td><?php echo $troquelado2?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"><hr class="hr_punteada_corto" /></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td><?php echo number_format($sum2,0,'','.')?></td>
                                        </tr>
                                    </table>
                                    <!--/mermas-->
                                </td>
                            </tr>
                            <tr>
                                <td class="celda_2">&nbsp;</td>
                                <td class="celda_1">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_2">&nbsp;</td>
                                <td class="celda_1">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_2"></td>
                                <td class="celda_1">&nbsp;</td>
                            </tr>
                        </table>
                        <div class="separador_20"></div>
                        <table id="tabla_detalle">
                            <tr>
                                <td class="celda_2">
                                   <!--
 CANTIDAD 0 sss: 3.000 TOTAL $400.247
                                    <br />
                                    CANTIDAD 1 : 3.000 TOTAL $393.782
                                    <br />
                                    CANTIDAD 2 : 3.000 TOTAL
                                    <br />
                                    CANTIDAD 3 : 3.000 TOTAL
									
									
-->    
                                </td>
                                <td class="celda_1">&nbsp;</td>
                                <td class="celda_60 valign_top" rowspan="5">
                                    <!--mermas-->
                                    <table id="tabla_produccion">
                                        <tr>
                                            <td colspan="4">Tabla de Patrón de MERMAS Microonda TIPO E + Tapa por <?php echo $datos->cantidad_3; ?> = <?php echo ($datos->cantidad_3 / $ing->unidades_por_pliego); ?> Pliegos -- Total Colores <?php echo ($fotomecanica->colores); ?> Barniz: <?php echo ($fotomecanica->fot_lleva_barniz); ?>
                                            Trabajos Externos: <?php echo $cantidadTrabajosExternos; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Imprenta</td>
                                            <!--<td>Ultra</td>-->
                                            <td>Roland:800</td>
                                            <td>Roland:800</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>Color 1-2-3</td>
                                            <td>400</td>
                                            <td>400</td>
                                            <td>&nbsp;</td>
                                            <td><?php echo $color1?></td>
                                        </tr>
                                        <tr>
                                            <td>Color &gt; 3</td>
                                            <td><?php if($datos->vb_maquina == 'SI' or $datos->acepta_excedentes == 'NO'){echo '150';}else{echo '100';}?></td>
                                            <td><?php if($datos->vb_maquina == 'SI' or $datos->acepta_excedentes == 'NO'){echo '150';}else{echo '100';}?></td>
                                            <td>* Color</td>
                                            <td><?php echo $color2?></td>
                                        </tr>
                                        <tr>
                                            <td>Cantidad</td>
                                            <td>100</td>
                                            <td>100</td>
                                            <td>Cantidad &gt; 5.000 * c/5.000</td>
                                            <td><?php echo $can5?></td>
                                        </tr>
<!--                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>050</td>
                                            <td>050</td>
                                            <td>Cantidad &gt; 5.000 * c/5.000</td>
                                            <td><?php// echo $can2?></td>
                                        </tr>-->
                                        <tr>
                                            <td>Barniz</td>
                                            <td>100</td>
                                            <td>100</td>
                                            <td>Primeros 1.000</td>
                                            <td><?php echo $bar5 ?></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>010</td>
                                            <td>010</td>
                                            <td>por cada 1.000 extra</td>
                                            <td><?php echo $bar6?></td>
                                        </tr>
<!--                                        <tr>
                                            <td>Laca</td>
                                            <td>025</td>
                                            <td>025</td>
                                            <td>una sola vez</td>
                                            <td><?php //echo $laca?></td>
                                        </tr>
                                        <tr>
                                            <td>Folia</td>
                                            <td>025</td>
                                            <td>025</td>
                                            <td>una sola vez</td>
                                            <td><?php// echo $folia?></td>
                                        </tr>
                                        <tr>
                                            <td>Trabajos Internos</td>
                                            <td>050</td>
                                            <td>050</td>
                                            <td>una sola vez</td>
                                            <td><?php //echo $termolaminado?></td>
                                            <td><?php //echo $totalTrabajosInternos?></td>
                                        </tr>-->
                                        <tr>
                                            <td>Trabajo externo</td>
                                            <td>050</td>
                                            <td>050</td>
                                            <td>una sola vez</td>					
                                            <td><?php echo $externo?></td>
                                        </tr>
                                        <tr>
                                            <td>Micro/Micro</td>
                                            <td>030</td>
                                            <td>030</td>
                                            <td>una sola vez</td>
                                            <td><?php echo $micromicro?></td>
                                        </tr>
                                        <tr>
                                            <td>Cart/Cart</td>
                                            <td>030</td>
                                            <td>030</td>
                                            <td>una sola vez</td>
                                            <td><?php echo $cartulina?></td>
                                        </tr>
                                        <tr>
                                            <td>Tamaños Normales</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>Emplacado</td>
                                            <td>015</td>
                                            <td>015</td>
                                            <td>por cada 1.000</td>
                                            <td><?php echo $emplacado3?></td>
                                        </tr>
                                        <tr>
                                            <td>Troquelado</td>
                                            <td>010</td>
                                            <td>010</td>
                                            <td>por cada 1.000</td>
                                            <td><?php echo $troquelado3?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"><hr class="hr_punteada_corto" /></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td><?php echo number_format($sum3,0,'','.')?></td>
                                        </tr>
                                    </table>
                                    <!--/mermas-->
                                </td>
                            </tr>
                            <tr>
                                <td class="celda_2">&nbsp;</td>
                                <td class="celda_1">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_2">&nbsp;</td>
                                <td class="celda_1">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_2"></td>
                                <td class="celda_1">&nbsp;</td>
                            </tr>
                        </table>
                        <div class="separador_20"></div>
                        <table id="tabla_detalle">
                            <tr>
                                <td class="celda_2">
                                   <!--
 CANTIDAD 0 sss: 3.000 TOTAL $400.247
                                    <br />
                                    CANTIDAD 1 : 3.000 TOTAL $393.782
                                    <br />
                                    CANTIDAD 2 : 3.000 TOTAL
                                    <br />
                                    CANTIDAD 3 : 3.000 TOTAL
									
									
-->    
                                </td>
                                <td class="celda_1">&nbsp;</td>
                                <td class="celda_60 valign_top" rowspan="5">
                                    <!--mermas-->
                                    <table id="tabla_produccion">
                                        <tr>
                                            <td colspan="4">Tabla de Patrón de MERMAS Microonda TIPO E + Tapa por <?php echo $datos->cantidad_4; ?> = <?php echo ($datos->cantidad_4 / $ing->unidades_por_pliego); ?> Pliegos -- Total Colores <?php echo ($fotomecanica->colores); ?> Barniz: <?php echo ($fotomecanica->fot_lleva_barniz); ?>
                                            Trabajos Externos: <?php echo $cantidadTrabajosExternos; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Imprenta</td>
                                            <!--<td>Ultra</td>-->
                                            <td>Roland:800</td>
                                            <td>Roland:800</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>Color 1-2-3</td>
                                            <td>400</td>
                                            <td>400</td>
                                            <td>&nbsp;</td>
                                            <td><?php echo $color1?></td>
                                        </tr>
                                        <tr>
                                            <td>Color &gt; 3</td>
                                            <td><?php if($datos->vb_maquina == 'SI' or $datos->acepta_excedentes == 'NO'){echo '150';}else{echo '100';}?></td>
                                            <td><?php if($datos->vb_maquina == 'SI' or $datos->acepta_excedentes == 'NO'){echo '150';}else{echo '100';}?></td>
                                            <td>* Color</td>
                                            <td><?php echo $color2?></td>
                                        </tr>
                                        <tr>
                                            <td>Cantidad</td>
                                            <td>100</td>
                                            <td>100</td>
                                            <td>Cantidad &gt; 5.000 * c/5.000</td>
                                            <td><?php echo $can7?></td>
                                        </tr>
<!--                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>050</td>
                                            <td>050</td>
                                            <td>Cantidad &gt; 5.000 * c/5.000</td>
                                            <td><?php// echo $can2?></td>
                                        </tr>-->
                                        <tr>
                                            <td>Barniz</td>
                                            <td>100</td>
                                            <td>100</td>
                                            <td>Primeros 1.000</td>
                                            <td><?php echo $bar7 ?></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>010</td>
                                            <td>010</td>
                                            <td>por cada 1.000 extra</td>
                                            <td><?php echo $bar8?></td>
                                        </tr>
<!--                                        <tr>
                                            <td>Laca</td>
                                            <td>025</td>
                                            <td>025</td>
                                            <td>una sola vez</td>
                                            <td><?php //echo $laca?></td>
                                        </tr>
                                        <tr>
                                            <td>Folia</td>
                                            <td>025</td>
                                            <td>025</td>
                                            <td>una sola vez</td>
                                            <td><?php// echo $folia?></td>
                                        </tr>
                                        <tr>
                                            <td>Trabajos Internos</td>
                                            <td>050</td>
                                            <td>050</td>
                                            <td>una sola vez</td>
                                            <td><?php //echo $termolaminado?></td>
                                            <td><?php //echo $totalTrabajosInternos?></td>
                                        </tr>-->
                                        <tr>
                                            <td>Trabajo externo</td>
                                            <td>050</td>
                                            <td>050</td>
                                            <td>una sola vez</td>					
                                            <td><?php echo $externo?></td>
                                        </tr>
                                        <tr>
                                            <td>Micro/Micro</td>
                                            <td>030</td>
                                            <td>030</td>
                                            <td>una sola vez</td>
                                            <td><?php echo $micromicro?></td>
                                        </tr>
                                        <tr>
                                            <td>Cart/Cart</td>
                                            <td>030</td>
                                            <td>030</td>
                                            <td>una sola vez</td>
                                            <td><?php echo $cartulina?></td>
                                        </tr>
                                        <tr>
                                            <td>Tamaños Normales</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>Emplacado</td>
                                            <td>015</td>
                                            <td>015</td>
                                            <td>por cada 1.000</td>
                                            <td><?php echo $emplacado4?></td>
                                        </tr>
                                        <tr>
                                            <td>Troquelado</td>
                                            <td>010</td>
                                            <td>010</td>
                                            <td>por cada 1.000</td>
                                            <td><?php echo $troquelado4?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"><hr class="hr_punteada_corto" /></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td><?php echo number_format($sum4,0,'','.')?></td>
                                        </tr>
                                    </table>
                                    <!--/mermas-->
                                </td>
                            </tr>
                            <tr>
                                <td class="celda_2">&nbsp;</td>
                                <td class="celda_1">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_2">&nbsp;</td>
                                <td class="celda_1">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="celda_2"></td>
                                <td class="celda_1">&nbsp;</td>
                            </tr>
                        </table>
                    </div>
                
            </header>
            
            
            
            <div class="separador_20"><hr /></div>
            
            <?php
                            if (($datos->cantidad_1>0) and ($ing->unidades_por_pliego>0))
                                $costoPlacaKilo=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                            else 
                                $costoPlacaKilo=0;
                            $valorPlacaKilo=($costoPlacaKilo*$tamano1*$tamano2*$tapaGramaje)/10000000;
                            $totalPlacaKilo=$valorPlacaKilo*$tapaPrecio;
							
                             if(sizeof($hoja)>=1 and $hoja->fecha)
                            {
                                $arreglo5=array
                                (
                                    "placa_kilo"=>$costoPlacaKilo,
                                    "total_pliegos"=>$valorPlacaKilo,
                                );
                                $this->db->where('id', $hoja->id);
                                $this->db->update("hoja_de_costos_datos",$arreglo5);
                            }
			    if(sizeof($hoja)>=1)
                            {
                                $arreglokilo1=array
                                (
                                    "kilos_placa"=>$valorPlacaKilo,
                                 
                                );
                                $this->db->where('id', $hoja->id);
                                $this->db->update("hoja_de_costos_datos",$arreglokilo1);
                            }
                        
                            $dos=($datos->cantidad_2/$ing->unidades_por_pliego)+$sum2."<br />";
                            $tres=($datos->cantidad_3/$ing->unidades_por_pliego)+$sum3."<br />";
                            $cuatro=($datos->cantidad_4/$ing->unidades_por_pliego)+$sum4."<br />";
                            $valorPlacaKilo2=(($dos*$tamano1*$tamano2*$tapaGramaje)/10000000)."<br />";
                            $valorPlacaKilo3=(($tres*$tamano1*$tamano2*$tapaGramaje)/10000000)."<br />";
                            $valorPlacaKilo4=(($cuatro*$tamano1*$tamano2*$tapaGramaje)/10000000)."<br />";
                            $totalPlacaKilo2=$valorPlacaKilo2*$materialidad_1->precio."<br />";
                            $totalPlacaKilo3=$valorPlacaKilo3*$materialidad_1->precio."<br />";
                            $totalPlacaKilo4=$valorPlacaKilo4*$materialidad_1->precio."<br />";
                            $v2= number_format((($datos->cantidad_2/$ing->unidades_por_pliego)*1.04)+104,0,'','.');
                            $v3= number_format((($datos->cantidad_3/$ing->unidades_por_pliego)*1.04)+104,0,'','.');
                            $v4= number_format((($datos->cantidad_4/$ing->unidades_por_pliego)*1.04)+104,0,'','.');
                            $OndaKilo2=number_format((($v2*$tamano1*$tamano2*$GramosMetroCuadrado)/10000),0,'','.')."<br />";
                            $OndaKilo3=number_format((($v3*$tamano1*$tamano2*$GramosMetroCuadrado)/10000),0,'','.')."<br />";
                            $OndaKilo4=number_format((($v4*$tamano1*$tamano2*$GramosMetroCuadrado)/10000),0,'','.')."<br />";
                            $vt2=number_format((($v2*$tamano1*$tamano2*$GramosMetroCuadrado)/10000)*$costo_kilo,0,'','.')."<br />";
                            $vt3=number_format((($v3*$tamano1*$tamano2*$GramosMetroCuadrado)/10000)*$costo_kilo,0,'','.')."<br />";
                            $vt4=number_format((($v4*$tamano1*$tamano2*$GramosMetroCuadrado)/10000)*$costo_kilo,0,'','.')."<br />";
                            //echo number_format($totalPlacaKilo2,0,'','.')."<br>";
                            
                            $totalDefi1=$totalPlacaKilo2+((($v2*$tamano1*$tamano2*$GramosMetroCuadrado)/10000)*$costo_kilo);
                            $totalDefi2=$totalPlacaKilo3+((($v3*$tamano1*$tamano2*$GramosMetroCuadrado)/10000)*$costo_kilo);
                            $totalDefi3=$totalPlacaKilo4+((($v4*$tamano1*$tamano2*$GramosMetroCuadrado)/10000)*$costo_kilo);
                            $totalDef2=number_format($totalDefi1,0,'','.');
                            $totalDef3=number_format($totalDefi2,0,'','.');
                            $totalDef4=number_format($totalDefi3,0,'','.');
                            //echo "<h1>".$datos->cantidad_2."</h1>";
                            ?>
            <table>
                <th>Cantidad Dos<?php echo $datos->cantidad_2 / $ing->unidades_por_pliego ?></th>
                        <tr>
                             <td class="celda_3" colspan="4"><br /></td>
                        </tr>
                        <tr>
                                <td class="celda_3">TAPA KILO  :<?php echo number_format($valorPlacaKilo2,0,'','.');/*echo $sum;*/?></td>
                                <td class="celda_3"><?php echo number_format(($datos->cantidad_2/$ing->unidades_por_pliego)+$sum2,0,'','.')?></td>
                                <td class="celda_3"><?php echo number_format($totalPlacaKilo2,0,'','.')?></td>
                                <td class="celda_3 valign_top padding_left_10" colspan="3" rowspan="30"></td>
                        </tr>
                        <tr>
					  <?php
								if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
								{
									
									
							//$costoPlacaKilo2=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
							$costoPlacaKilo2 = ($datos->cantidad_1/$ing->unidades_por_pliego);
                            
							
							$dos_por_ciento = ($costoPlacaKilo2 / 100)* 2;
							
							if($costoPlacaKilo2 >= 1 and $costoPlacaKilo2 <= 100)
							{
								$agregado_a_apliegos = 100;
							}
							
							if($costoPlacaKilo2 > 100)
							{
								$agregado_a_apliegos = $dos_por_ciento;
							}
							$costoPlacaKilo2 = $costoPlacaKilo2 + $agregado_a_apliegos;
							$valorPlacaKilo2 = ($costoPlacaKilo2*$tamano1*$tamano2*$tapaGramaje2)/10000000;
                            $totalPlacaKilo2 = $valorPlacaKilo2*$tapaPrecio2;
							
					  ?>
										<td class="celda_3">TAPA KILO (RESPALDO):<?php echo number_format($valorPlacaKilo2,0,'','.');?></td>
										<td class="celda_3"><?php echo number_format($costoPlacaKilo2,0,'','.')?></td>
										<td class="celda_3"><?php echo number_format($totalPlacaKilo2,0,'','.')?></td>
					 <?php		
								}
								else
								{
						?>		
                                <td class="celda_3">ONDA KILO <?php echo $OndaKilo2;?></td>
                                <td class="celda_3"><?php echo number_format((($datos->cantidad_2/$ing->unidades_por_pliego)*1.04)+104,0,'','.');?></td>
                                <td class="celda_3"><?php echo $vt2 ?></td>
								
							<?php
								}
							?>
                            </tr>
                            <!--
                            <tr>
                                <td class="celda_3">SEDAS</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            -->
                            <tr>
                                <td class="celda_3">VARIOS</td>
                                <td class="celda_3">0</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <?php
							if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
								{
									$totalMateriaPrima= $totalPlacaKilo+$totalPlacaKilo2;
								}else
								{
									$totalMateriaPrima= $totalOndaKilo+$totalPlacaKilo;	
								}
                            
                            ?>
                      <tr>
                                <td class="celda_3"><span class="subrayado_top">TOTAL MATERIA PRIMA</span></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo $totalDef2 ?></td>
                            </tr>
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                             
                      <tr>
            </table>
            <?php
                            if (($datos->cantidad_1>0) and ($ing->unidades_por_pliego>0))
                                $costoPlacaKilo=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                            else 
                                $costoPlacaKilo=0;
                            $valorPlacaKilo=($costoPlacaKilo*$tamano1*$tamano2*$tapaGramaje)/10000000;
                            $totalPlacaKilo=$valorPlacaKilo*$tapaPrecio;
							
                             if(sizeof($hoja)>=1 and $hoja->fecha)
                            {
                                $arreglo5=array
                                (
                                    "placa_kilo"=>$costoPlacaKilo,
                                    "total_pliegos"=>$valorPlacaKilo,
                                );
                                $this->db->where('id', $hoja->id);
                                $this->db->update("hoja_de_costos_datos",$arreglo5);
                            }
			    if(sizeof($hoja)>=1)
                            {
                                $arreglokilo1=array
                                (
                                    "kilos_placa"=>$valorPlacaKilo,
                                 
                                );
                                $this->db->where('id', $hoja->id);
                                $this->db->update("hoja_de_costos_datos",$arreglokilo1);
                            }
                        ?>
            <table>
                <th>Cantidad tres <?php echo $datos->cantidad_3 / $ing->unidades_por_pliego ?></th>
                        <tr>
                             <td class="celda_3" colspan="4"><br /></td>
                        </tr>
                        <tr>
                                <td class="celda_3">TAPA KILO  :<?php echo number_format($valorPlacaKilo3,0,'','.');/*echo $sum;*/?></td>
                                <td class="celda_3"><?php echo number_format(($datos->cantidad_3/$ing->unidades_por_pliego)+$sum3,0,'','.')?></td>
                                <td class="celda_3"><?php echo number_format($totalPlacaKilo3,0,'','.')?></td>
                                <td class="celda_3 valign_top padding_left_10" colspan="3" rowspan="30"></td>
                        </tr>
                        <tr>
					  <?php
								if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
								{
									
									
							//$costoPlacaKilo2=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
							$costoPlacaKilo2 = ($datos->cantidad_1/$ing->unidades_por_pliego);
                            
							
							$dos_por_ciento = ($costoPlacaKilo2 / 100)* 2;
							
							if($costoPlacaKilo2 >= 1 and $costoPlacaKilo2 <= 100)
							{
								$agregado_a_apliegos = 100;
							}
							
							if($costoPlacaKilo2 > 100)
							{
								$agregado_a_apliegos = $dos_por_ciento;
							}
							$costoPlacaKilo2 = $costoPlacaKilo2 + $agregado_a_apliegos;
							$valorPlacaKilo2 = ($costoPlacaKilo2*$tamano1*$tamano2*$tapaGramaje2)/10000000;
                            $totalPlacaKilo2 = $valorPlacaKilo2*$tapaPrecio2;
							
					  ?>
										<td class="celda_3">TAPA KILO (RESPALDO):<?php echo number_format($valorPlacaKilo2,0,'','.');?></td>
										<td class="celda_3"><?php echo number_format($costoPlacaKilo2,0,'','.')?></td>
										<td class="celda_3"><?php echo number_format($totalPlacaKilo2,0,'','.')?></td>
					 <?php		
								}
								else
								{
						?>		
                                <td class="celda_3">ONDA KILO <?php echo $OndaKilo3;?></td>
                                <td class="celda_3"><?php echo number_format((($datos->cantidad_3/$ing->unidades_por_pliego)*1.04)+104,0,'','.');?></td>
                                <td class="celda_3"><?php echo $vt3 ?></td>
								
							<?php
								}
							?>
                            </tr>
                            <!--
                            <tr>
                                <td class="celda_3">SEDAS</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            -->
                            <tr>
                                <td class="celda_3">VARIOS</td>
                                <td class="celda_3">0</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <?php
							if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
								{
									$totalMateriaPrima= $totalPlacaKilo+$totalPlacaKilo2;
								}else
								{
									$totalMateriaPrima= $totalOndaKilo+$totalPlacaKilo;	
								}
                            
                            ?>
                      <tr>
                                <td class="celda_3"><span class="subrayado_top">TOTAL MATERIA PRIMA</span></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo $totalDef3 ?></td>
                            </tr>
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                             
                      <tr>
            </table>
            <?php
                            if (($datos->cantidad_1>0) and ($ing->unidades_por_pliego>0))
                                $costoPlacaKilo=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                            else 
                                $costoPlacaKilo=0;
                            $valorPlacaKilo=($costoPlacaKilo*$tamano1*$tamano2*$tapaGramaje)/10000000;
                            $totalPlacaKilo=$valorPlacaKilo*$tapaPrecio;
							
                             if(sizeof($hoja)>=1 and $hoja->fecha)
                            {
                                $arreglo5=array
                                (
                                    "placa_kilo"=>$costoPlacaKilo,
                                    "total_pliegos"=>$valorPlacaKilo,
                                );
                                $this->db->where('id', $hoja->id);
                                $this->db->update("hoja_de_costos_datos",$arreglo5);
                            }
			    if(sizeof($hoja)>=1)
                            {
                                $arreglokilo1=array
                                (
                                    "kilos_placa"=>$valorPlacaKilo,
                                 
                                );
                                $this->db->where('id', $hoja->id);
                                $this->db->update("hoja_de_costos_datos",$arreglokilo1);
                            }
                        ?>
            <table>
                <th>Cantidad Cuatro <?php echo $datos->cantidad_4 / $ing->unidades_por_pliego ?></th>
                        <tr>
                             <td class="celda_3" colspan="4"><br /></td>
                        </tr>
                        <tr>
                                <td class="celda_3">TAPA KILO  :<?php echo number_format($valorPlacaKilo4,0,'','.');/*echo $sum;*/?></td>
                                <td class="celda_3"><?php echo number_format(($datos->cantidad_4/$ing->unidades_por_pliego)+$sum4,0,'','.')?></td>
                                <td class="celda_3"><?php echo number_format($totalPlacaKilo4,0,'','.')?></td>
                                <td class="celda_3 valign_top padding_left_10" colspan="3" rowspan="30"></td>
                        </tr>
                        <tr>
					  <?php
								if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
								{
									
									
							//$costoPlacaKilo2=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
							$costoPlacaKilo2 = ($datos->cantidad_1/$ing->unidades_por_pliego);
                            
							
							$dos_por_ciento = ($costoPlacaKilo2 / 100)* 2;
							
							if($costoPlacaKilo2 >= 1 and $costoPlacaKilo2 <= 100)
							{
								$agregado_a_apliegos = 100;
							}
							
							if($costoPlacaKilo2 > 100)
							{
								$agregado_a_apliegos = $dos_por_ciento;
							}
							$costoPlacaKilo2 = $costoPlacaKilo2 + $agregado_a_apliegos;
							$valorPlacaKilo2 = ($costoPlacaKilo2*$tamano1*$tamano2*$tapaGramaje2)/10000000;
                            $totalPlacaKilo2 = $valorPlacaKilo2*$tapaPrecio2;
							
					  ?>
										<td class="celda_3">TAPA KILO (RESPALDO):<?php echo number_format($valorPlacaKilo2,0,'','.');?></td>
										<td class="celda_3"><?php echo number_format($costoPlacaKilo2,0,'','.')?></td>
										<td class="celda_3"><?php echo number_format($totalPlacaKilo2,0,'','.')?></td>
					 <?php		
								}
								else
								{
						?>		
                                <td class="celda_3">ONDA KILO <?php echo $OndaKilo4;?></td>
                                <td class="celda_3"><?php echo number_format((($datos->cantidad_4/$ing->unidades_por_pliego)*1.04)+104,0,'','.');?></td>
                                <td class="celda_3"><?php echo $vt4 ?></td>
								
							<?php
								}
							?>
                            </tr>
                            <!--
                            <tr>
                                <td class="celda_3">SEDAS</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            -->
                            <tr>
                                <td class="celda_3">VARIOS</td>
                                <td class="celda_3">0</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                            <?php
							if($fotomecanica->materialidad_datos_tecnicos == 'Cartulina-cartulina')
								{
									$totalMateriaPrima= $totalPlacaKilo+$totalPlacaKilo2;
								}else
								{
									$totalMateriaPrima= $totalOndaKilo+$totalPlacaKilo;	
								}
                            
                            ?>
                      <tr>
                                <td class="celda_3"><span class="subrayado_top">TOTAL MATERIA PRIMA</span></td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3"><?php echo $totalDef4 ?></td>
                            </tr>
                            <tr>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                                <td class="celda_3">&nbsp;</td>
                            </tr>
                             
                      <tr>
            </table>
            <div class="separador_20"><hr /></div>
            <!-------------------------Segundo Cuadro-------------------->
            <?php
                                $externos_produccion=0;
				if($fotomecanica->acabado_impresion_4=="17")
                                {
                                    $acabado_4="";
                                    $acabado_4Valor="";
                                    $acabado_4MedidaMasValorVenta="";
                                    $acabado_4Unitario="";
                                    $acabado_4UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_4Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_4);
                                    $acabado_4=$acabado_4Array->caracteristicas; // Nombre acabado
                                    $acabado_4UnidadVentaNombre=$acabado_4Array->unv; //Nombre unidad de venta
                                    $acabado_4Valor=$acabado_4Array->valor_venta; // ej: 52
                                    $acabado_4MedidaMasValorVenta=($tamano1*$tamano2*$acabado_4Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_4CostoFijo=$acabado_4Array->costo_fijo;	
                                    
                                    if ($acabado_4Array->unidad_de_venta == '1') //Metros
                                    {
                                        $costo_unitario4=$acabado_4MedidaMasValorVenta;
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_2);
                                        $cantidad_4=$datos->cantidad_2;
                                    }
                                    elseif ($acabado_4Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $costo_unitario4=$acabado_4Valor;
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }  
                                    elseif ($acabado_4Array->unidad_de_venta == '3') //tONELADA
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_2);
                                    }                                    
                                    elseif ($acabado_4Array->unidad_de_venta == '4') //caja de carton
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_2);
                                    }                                            
                                    elseif ($acabado_4Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($datos->cantidad_2*$acabado_4Valor);
                                        $cantidad_4=$datos->cantidad_2;
                                    }       
                                    elseif ($acabado_4Array->unidad_de_venta == '6') //cm2
                                    {
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $costo_unitario4=$acabado_4Valor;     
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }   
                                    elseif ($acabado_4Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario4=$acabado_4MedidaMasValorVenta;
                                        $precio_total_4=$acabado_4MedidaMasValorVenta*$datos->cantidad_2;
                                        $cantidad_4=$datos->cantidad_2;
                                    }
                                    elseif ($acabado_4Array->unidad_de_venta == '8') //cms
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_2);
                                    }           
                                    elseif ($acabado_4Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }     
                                    elseif ($acabado_4Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($acabado_4Valor*$datos->cantidad_2);
                                        $cantidad_4=$datos->cantidad_2;                                        
                                    }                                      
                                }
								
                                if($fotomecanica->acabado_impresion_5=="17")
                                {
                                    $acabado_5="";
                                    $acabado_5Valor="";
                                    $acabado_5MedidaMasValorVenta="";
                                    $acabado_5Unitario="";
                                    $acabado_5UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_5Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_5);
                                    $acabado_5=$acabado_5Array->caracteristicas;
                                    $acabado_5UnidadVentaNombre=$acabado_5Array->unv; //Nombre unidad de venta
                                    $acabado_5Valor=$acabado_5Array->valor_venta; // ej: 52
                                    $acabado_5MedidaMasValorVenta=($tamano1*$tamano2*$acabado_5Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_5CostoFijo=$acabado_5Array->costo_fijo;		
                                  if ($acabado_5Array->unidad_de_venta == '1') //mt2
                                    {
                                        $costo_unitario5=$acabado_5MedidaMasValorVenta;
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_2);                                      
                                        $cantidad_5=$datos->cantidad_2;
                                    }
                                    elseif ($acabado_5Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $costo_unitario5=$acabado_5Valor; 
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }    
                                    elseif ($acabado_5Array->unidad_de_venta == '3') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_2);
                                    }                                    
                                    elseif ($acabado_5Array->unidad_de_venta == '4') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_2);
                                    }                                            
                                    elseif ($acabado_5Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($datos->cantidad_2*$acabado_5Valor);
                                        $cantidad_5=$datos->cantidad_2;
                                    }       
                                    elseif ($acabado_5Array->unidad_de_venta == '6') //mt2
                                    {
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $costo_unitario5=$acabado_5Valor;
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }   
                                    elseif ($acabado_5Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario5=$acabado_5MedidaMasValorVenta;
                                        $precio_total_5=$acabado_5MedidaMasValorVenta*$datos->cantidad_2;
                                        $cantidad_5=$datos->cantidad_2;
                                    }
                                    elseif ($acabado_5Array->unidad_de_venta == '8') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_2);
                                    }           
                                    elseif ($acabado_5Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }   
                                    elseif ($acabado_5Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($acabado_5Valor*$datos->cantidad_2);
                                        $cantidad_5=$datos->cantidad_2;
                                    }                                      
                                }    
                                if($fotomecanica->acabado_impresion_6=="17")
                                {
                                    $acabado_6="";
                                    $acabado_6Valor="";
                                    $acabado_6MedidaMasValorVenta="";
                                    $acabado_6Unitario="";
                                    $acabado_6UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_6Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_6);
                                    $acabado_6=$acabado_6Array->caracteristicas;
                                    $acabado_6UnidadVentaNombre=$acabado_6Array->unv; //Nombre unidad de venta
                                    $acabado_6Valor=$acabado_6Array->valor_venta; // ej: 52
                                    $acabado_6MedidaMasValorVenta=($tamano1*$tamano2*$acabado_6Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_6CostoFijo=$acabado_6Array->costo_fijo;		
                                    if ($acabado_6Array->unidad_de_venta == '1') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_2);
                                    }
                                    elseif ($acabado_6Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $costo_unitario6=$acabado_6Valor; 
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    }  
                                    elseif ($acabado_6Array->unidad_de_venta == '3') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_2);
                                    }                                    
                                    elseif ($acabado_6Array->unidad_de_venta == '4') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_2);
                                    }                                            
                                    elseif ($acabado_6Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($datos->cantidad_2*$acabado_5Valor);
                                        $cantidad_6=$datos->cantidad_2;
                                    }       
                                    elseif ($acabado_6Array->unidad_de_venta == '6') //mt2
                                    {
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $costo_unitario6=$acabado_6Valor;
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    }   
                                    elseif ($acabado_6Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario6=$acabado_6MedidaMasValorVenta;
                                        $precio_total_6=$acabado_6MedidaMasValorVenta*$datos->cantidad_2;
                                        $cantidad_6=$datos->cantidad_2;
                                    }
                                    elseif ($acabado_6Array->unidad_de_venta == '8') //cms
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_2);
                                    }           
                                    elseif ($acabado_6Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    } 
                                    elseif ($acabado_6Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($acabado_6Valor*$datos->cantidad_2);
                                        $cantidad_6=$datos->cantidad_2;
                                    }                                      
									

                                }           
               ?>
            <!-------------------------Calculos de Produccion-------------------->
            <?php
//            echo $datos->cantidad_1."<br>";
//            echo $ing->unidades_por_pliego."<br>";
//            echo $sum."<br>";
//            echo $factor_rango."<br>";
//            echo $base_imprenta->precio."<br>";
//            echo $fotomecanica->colores."<br>";
//            echo $barniz2."<br>";
//            echo $recargo800Array->precio."<br>";
//            echo $fotomecanica->fot_lleva_barniz."<br>";
//            $barniz2=1;
//            $tira1=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2)."<br>";
//            $tira2=((($datos->cantidad_1/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
//            $total1=$tira1+$tira2."<br>";
//            $barniz2=0;
            //echo $externos_produccion."<br>";;
            //echo $externos_produccion."<br>";
            //echo $hoja->valor_externo;exit();
            $tira3=((($datos->cantidad_2/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2)."<br>";
            $tira4=((($datos->cantidad_2/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
            $tirajetotal2=$tira3+$tira4."<br>";
            
            $tira5=((($datos->cantidad_3/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2)."<br>";
            $tira6=((($datos->cantidad_4/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
            $tirajetotal3=$tira5+$tira6."<br>";
            
            $tira7=((($datos->cantidad_4/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio )*($fotomecanica->colores+$barniz2)."<br>";
            $tira8=((($datos->cantidad_4/$ing->unidades_por_pliego)+$sum)*$factor_rango+$base_imprenta->precio)*($fotomecanica->colores+$barniz2)*(1*$recargo800Array->precio/100);
            $tirajetotal4=$tira7+$tira8."<br>";
            //exit();
            //valor corte para los 4
            $valorCorte2=(((($datos->cantidad_2/$ing->unidades_por_pliego)*1.04)+104)*4.5);
            $valorCorte3=(((($datos->cantidad_3/$ing->unidades_por_pliego)*1.04)+104)*4.5);
            $valorCorte4=(((($datos->cantidad_4/$ing->unidades_por_pliego)*1.04)+104)*4.5);
            
           $costoOnda2=(((($datos->cantidad_2/$ing->unidades_por_pliego)*1.04)+104))."<br>";
           $costoOnda3=(((($datos->cantidad_3/$ing->unidades_por_pliego)*1.04)+104))."<br>";
           $costoOnda4=(((($datos->cantidad_4/$ing->unidades_por_pliego)*1.04)+104))."<br>";
           
           // valor del emplacado 
           $variableEmplacado=$this->variables_cotizador_model->getVariablesCotizadorPorId(8);
           $valorEmplacadado=($variableEmplacado->precio*$tamano1*$tamano2)/10000;
           $totalEmplacado2=$valorEmplacadado*$costoOnda2."<br>";
           $totalEmplacado3=$valorEmplacadado*$costoOnda3."<br>";
           $totalEmplacado4=$valorEmplacadado*$costoOnda4."<br>";
           
           
            ?>
            <table id="tabla_detalle" style="width: 450px">
                            <tr>
                                <td colspan="3"><hr class="hr_punteada" /></td>
                            </tr>
                            <tr>
                                <td colspan="3"><b>CANTIDAD DOS: <?php echo $datos->cantidad_2 ?> TIRAJE::: <?php echo $datos->cantidad_2 / $ing->unidades_por_pliego ?></b></td>
                            </tr>
                            <tr>
                                <td colspan="3"><hr class="hr_punteada" /></td>
                            </tr>
                            <tr>
                                <td class="celda_3">PRODUCCIÓN</td>
                                <td class="celda_3">UNITARIO</td>
                                <td class="celda_3">VALOR $</td>
                            </tr>
                            <tr>
                                <td colspan="3"><hr class="hr_punteada" /></td>
                            </tr>
                        <?php
                            if (($datos->cantidad_1>0) and ($ing->unidades_por_pliego>0))
                                $costoPlacaKilo=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                            else 
                                $costoPlacaKilo=0;
                            $valorPlacaKilo=($costoPlacaKilo*$tamano1*$tamano2*$tapaGramaje)/10000000;
                            $totalPlacaKilo=$valorPlacaKilo*$tapaPrecio;
							
                             if(sizeof($hoja)>=1 and $hoja->fecha)
                            {
                                $arreglo5=array
                                (
                                    "placa_kilo"=>$costoPlacaKilo,
                                    "total_pliegos"=>$valorPlacaKilo,
                                );
                                $this->db->where('id', $hoja->id);
                                $this->db->update("hoja_de_costos_datos",$arreglo5);
                            }
			    if(sizeof($hoja)>=1)
                            {
                                $arreglokilo1=array
                                (
                                    "kilos_placa"=>$valorPlacaKilo,
                                 
                                );
                                $this->db->where('id', $hoja->id);
                                $this->db->update("hoja_de_costos_datos",$arreglokilo1);
                            }
                            
       if (($datos->cantidad_2>0) and ($ing->unidades_por_pliego>0))
       {    
           $tiraje=$datos->cantidad_2/$ing->unidades_por_pliego;
       }
       else{ 
       $tiraje=0;
       }
       if($tiraje<4000)
       {
         $tiraje2="Menos de 4.000";
         $factor_rangos=$this->variables_cotizador_model->getVariablesCotizadorPorId(17);
         $factor_rango=$factor_rangos->precio;
       }elseif($tiraje>4000 and $tiraje<10000)
       {
         $tiraje2="4.001 a 10.000";
         $factor_rangos=$this->variables_cotizador_model->getVariablesCotizadorPorId(18);
         $factor_rango=$factor_rangos->precio;
       }else
       {
        $tiraje2="Más de 10.000";
        $factor_rangos=$this->variables_cotizador_model->getVariablesCotizadorPorId(19);
        echo $factor_rango=$factor_rangos->precio;
       }
                        ?>
                        <tr>
                                    <!--producción-->
                                    <table id="tabla_produccion">
                                        <tr>
                                            <td class="celda_33">TIRAJE</td>
                                            <td class="celda_33"><?php echo $factor_rango?></td>
                                            <td class="celda_33"><?php echo number_format($tirajetotal2,0,'','.')?></td>
                                        </tr>
                                  <?php
                                  $variableComplemento=$this->variables_cotizador_model->getVariablesCotizadorPorId(32);
                                        $valorTiraje=$variableComplemento->precio-$tiraje;
										
                                        if($valorTiraje>0)
                                        {
                                            if($fotomecanica->colores == 0)
                                            {
                                              $complemento=0;
                                            }else{
                                              $complemento=$valorTiraje;	
                                            }
                                            
											
                                        }else
                                        {
                                            $complemento=0;
                                        }
                                        
                                        
                                  ?>  
					<?php if($hoja->valor_externo!=0){ $externos_produccion=$externos_produccion+$hoja->valor_externo; }else{  $externos_produccion=$precio_total_4+$precio_total_5+$precio_total_6; } ?>			  

								  
                    <tr>
                                            <td class="celda_33">COMPLEMENTO</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($complemento,0,'','.')?></td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33">EXTERNOS</td>
                                            <td class="celda_33">&nbsp;</td>

                                            <td class="celda_33"><?php echo number_format($externos_produccion,0,'','.');?></td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33">COSTOS POR LACADO</td>
                                            <td class="celda_33">&nbsp;</td>

                                            <td class="celda_33"><?php echo number_format($costosporlacado2,0,'','.');?></td>
                                        </tr>
                    <?php
                        if($maquina=="Máquina Roland 800")
                        {
                           if (($datos->cantidad_1>0) and ($ing->unidades_por_pliego>0))
                                $costoOndaKilo=((($datos->cantidad_1/$ing->unidades_por_pliego)*1.04)+100)+4;
                            else 
                                $costoOndaKilo=0;                            
                        }else
                        {
                           if (($datos->cantidad_1>0) and ($ing->unidades_por_pliego>0))
                                $costoOndaKilo=(($datos->cantidad_1/$ing->unidades_por_pliego)+100)+4;
                            else 
                                $costoOndaKilo=0;                               
                        }
                        
                        if($fotomecanica->materialidad_datos_tecnicos == 'Sólo Cartulina')
                        {
                                $costoOndaKilo=0;
                                $valorOndaKilo=0;
                                $totalOndaKilo=0;
                                $valorCorte=0;

                        }else{
                            $valorOndaKilo=($costoOndaKilo*$tamano1*$tamano2*$GramosMetroCuadrado)/10000000;
                            $totalOndaKilo=$valorOndaKilo*$costo_kilo;
                            $valorCorte=$costoOndaKilo*4.5;
			}
                        
                        $costoOndaKilo1=((($datos->cantidad_1/$ing->unidades_por_pliego)*1.04)+100)+4;
                        $costoOndaKilo2=(($datos->cantidad_1/$ing->unidades_por_pliego)+$emplacado+$troquelado);
                        
                        if($costoOndaKilo1>$costoOndaKilo2){
                            $costoOndaKilo=$costoOndaKilo1;
                        }
                        if($costoOndaKilo1<$costoOndaKilo2){
                            $costoOndaKilo=$costoOndaKilo2;
                        }
                        
                    ?>
                    <tr>
                            <td class="celda_33">CORTE</td>
                            <td class="celda_33">4.5</td>
                            <td class="celda_33"><?php echo number_format($valorCorte2,0,'','.')?></td>
                    </tr>
                    <?php
                        $variableEmplacado=$this->variables_cotizador_model->getVariablesCotizadorPorId(8);
                        $valorEmplacadado=($variableEmplacado->precio*$tamano1*$tamano2)/10000;
                        $totalEmplacado=$valorEmplacadado*$costoOndaKilo;
                    ?>
                    <tr>
                        <td class="celda_33">EMPLACADO</td>
                        <td class="celda_33"><?php echo $valorEmplacadado?></td>
                        <td class="celda_33"><?php echo number_format($totalEmplacado2,0,'','.')?></td>
                    </tr>
                    <?php
                    
                        if($fotomecanica->estan_los_moldes == 'NO LLEVA')
                        {
                            $variableMontajeMoldeTroquel=0;
                            $totalMontajeMolde=0;
                        }else
                        {
                            $variableRecargoMontaje=$this->variables_cotizador_model->getVariablesCotizadorPorId(31);
                            $variableMontajeMoldeTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(10);
                            $totalMontajeMolde=$variableMontajeMoldeTroquel->precio*1.5;	
                        }                    

//                       

                    ?>
                    <tr>
                                            <td class="celda_33">MONTAJE MOLDE</td>
                                            <td class="celda_33"><?php echo number_format($variableMontajeMoldeTroquel->precio,0,'','.')?></td>
                                            <td class="celda_33"><?php echo number_format($totalMontajeMolde,0,'','.')?></td>
                                        </tr>
                    <?php
						if($fotomecanica->estan_los_moldes == 'NO LLEVA')
						{
                                                    $variableTroquelado=0;
                                                    $totalTroquelado=0;
						}else
						{
                                                    $variableTroquelado=$this->variables_cotizador_model->getVariablesCotizadorPorId(11);
                                                    $totalTroquelado=($costoOnda2*$variableTroquelado->precio)*1.5;	
						}                    
//						
                    ?>
                    <tr>
                                            <td class="celda_33">TROQUELADO</td>
                                            <td class="celda_33"><?php echo $variableTroquelado->precio?></td>
                                            <td class="celda_33"><?php echo number_format($totalTroquelado,0,'','.')?></td>
                    </tr>
                    <?php
                                        $variableDesgajado=$this->variables_cotizador_model->getVariablesCotizadorPorId(12);
                                        $totalDesgajado=$ing->piezas_totales_en_el_pliego*$variableDesgajado->precio*1.5*$costoOnda2;
                    ?>
                    <tr>
                                            <td class="celda_33">DESGAJADO (<?php echo "Piezas totales: ".$ing->piezas_totales_en_el_pliego;?>)</td>
                                            <td class="celda_33"><?php echo $variableDesgajado->precio?></td>
                                            <td class="celda_33"><?php echo number_format($totalDesgajado,0,'','.')?></td>
                    </tr>
                   
                     <tr>
                                            <td class="celda_33">PEGADO</td>
                                        <?php
                                        if(sizeof($hoja)==0) { 
                                                $variablePegado=$this->variables_cotizador_model->getVariablesCotizadorPorId(21);
                                                if ($datos->pegado_migrado==null) $pegado_migrado=1; else $pegado_migrado=$datos->pegado_migrado;
                                                $totalPegado=$datos->cantidad_2*$pegado_migrado*$variablePegado->precio;                                               
                                          ?>
                                                <td class="celda_33"><?php if($datos->pegado_migrado == ''){echo '30';}else{echo $datos->pegado_migrado;}?><a href="<?php echo base_url()?>hoja/pegado/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="pegado" placeholder="Descripcion técnica" value="<?php echo $datos->pegado_migrado?>" /></td>
					  <?php } else { 
                                                $variablePegado=$this->variables_cotizador_model->getVariablesCotizadorPorId(21);
                                                $totalPegado=$datos->cantidad_2*$hoja->pegado*$variablePegado->precio;                                              
                                          ?>
                                                <td class="celda_33"><?php if($hoja->pegado == ''){echo '30';}else{echo $hoja->pegado;}?><a href="<?php echo base_url()?>hoja/pegado/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="pegado" placeholder="Descripcion técnica" value="<?php echo $hoja->pegado?>" /></td>
					<?php }  ?>                                            
                                            
<!--                                            <td class="celda_33"><?php // if($hoja->pegado == ''){echo '30';}else{echo $hoja->pegado;}?><a href="<?php // echo base_url()?>hoja/pegado/<?php // echo $id?>/<?php // echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php // echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="pegado" placeholder="Descripcion técnica" value="<?php // echo $hoja->pegado?>" /></td>-->
                                                <td class="celda_33"><?php echo number_format($totalPegado,0,'','.')?><?php if ($datos->pegado_migrado==null){?> <strong> (Pegado de Cotizacion = 0 )</strong><?php } ?> </td> 
											
											
                     </tr>
                     <?php              //echo $hoja->pegado;exit();
					 if(sizeof($hoja->pegado)>=1)
					 {
                                            $divisionPegado=$hoja->pegado/2;
                                            $totalDespacho=$divisionPegado*$datos->cantidad_2;
					 }
					 else
					 {
                                             if ($datos->pegado_migrado=='')
                                                $divisionPegado=$presupuesto->costo_pegado/2;
                                             else
                                                $divisionPegado=$datos->pegado_migrado/2;
                                             $totalDespacho=$divisionPegado*$datos->cantidad_2;	 
					 }
					 
					 
                     
                     ?>
                     <tr>
                                            <td class="celda_33">DESPACHO</td>
                                            <td class="celda_33"><?php echo $divisionPegado?></td>
                                            <td class="celda_33"><?php echo number_format($totalDespacho,0,'','.')?></td>
                     </tr>
                     <?php
					 
					 	
					 
					 //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
					 
                    if($fotomecanica->condicion_del_producto == 'Nuevo') //nuevo 
                    {
                        if($fotomecanica->estan_los_moldes == 'NO')
			{
				$variableTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(9);
                                $moldeTroquel=$variableTroquel->precio;
                        }
                        elseif($fotomecanica->estan_los_moldes == 'NO LLEVA')
                        {
                            $moldeTroquel=0;
                        }elseif($fotomecanica->estan_los_moldes == 'CLIENTE LO APORTA')
                        {
                            $moldeTroquel=0;
                        }
                    }
                    if($fotomecanica->condicion_del_producto == 'Repetición Sin Cambios') //
                    {
//                        if($fotomecanica->estan_los_moldes == 'SI')
//			{
//				$variableTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(9);
//                                $moldeTroquel=$variableTroquel->precio;
//                        }
                    if($fotomecanica->estan_los_moldes == 'NO LLEVA')
                    {
                            $variableTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(9);
                            $moldeTroquel=$variableTroquel->precio;
                    }
                    }					
                    if($fotomecanica->condicion_del_producto == 'Repetición con Cambios') //
                    {
			$moldeTroquel=0;
                    }
                    if($fotomecanica->condicion_del_producto == 'Producto Genérico') //
                    {
			$moldeTroquel=0;
                    }
                    // $moldeTroquel=0;
                    //$variableTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(9);
                    //$moldeTroquel=$variableTroquel->precio;
                                            
									   
                     ?>
                     <tr>
                                            <td class="celda_33">MOLDE TROQUEL</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($moldeTroquel,0,'','.');?></td>
                                            <!-- <td class="celda_33"><?php //if($datos->condicion_del_producto=='Repetición Sin Cambios'){echo '0';}else{echo number_format($moldeTroquel,0,'','.');}?></td> -->
                     </tr>
					 <?php
					 $variableEmplacado=$this->variables_cotizador_model->getVariablesCotizadorPorId(39);
					 if($fotomecanica->lleva_barniz == 'SI' and $fotomecanica->reserva_barniz == 'SI')
					 {
						 $otrosCaucho = $variableEmplacado->precio; 
					 }else
					 {
						$otrosCaucho = 0;
					 }
					 
					 ?>
					 <tr>
                                            <td class="celda_33">CAUCHO</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($otrosCaucho,0,'','.');?></td>
                                            
                       
                     </tr>
					 <?php
                                        
                if($ing->piezas_adicionales == 'NO LLEVA')
                {
                    $piezaAdacionalNom1 ="No Lleva";
                    $piezaAdacionalValor1="&nbsp;";
                    $piezaAdacionalTotal1="&nbsp;";
                    $piezaAdacionalEmpresa1="&nbsp;";
                }else
                {
                    $piezasAdicionales = $this->piezas_adicionales_model->getPiezasAdicionalesPorNombreHojaCosto($ing->piezas_adicionales);
                    $piezaUnidadVentaNombre1=$piezasAdicionales->unv; //Nombre unidad de venta
                    $piezaAdacionalNom1 = $piezasAdicionales->piezas_adicionales;
                    $piezaAdacionalValor1= $piezasAdicionales->valor_venta;
                    $piezaAdacionalTotal1 = $datos->cantidad_2 * $piezaAdacionalValor1;
                    $piezaAdacionalEmpresa1= $hoja->piezas_adicionales1;
                     
                }
                if($ing->piezas_adicionales2 == 'NO LLEVA')
                {
                    $piezaAdacionalNom2 ="No Lleva";
                    $piezaAdacionalValor2="&nbsp;";
                    $piezaAdacionalTotal2="&nbsp;";
                    $piezaAdacionalEmpresa2="&nbsp;";
                }else
                {
                    $piezasAdicionales = $this->piezas_adicionales_model->getPiezasAdicionalesPorNombreHojaCosto($ing->piezas_adicionales2);
                    $piezaUnidadVentaNombre2=$piezasAdicionales->unv; //Nombre unidad de venta                                    
                    $piezaAdacionalNom2 = $piezasAdicionales->piezas_adicionales;
                    $piezaAdacionalValor2= $piezasAdicionales->valor_venta;
                    $piezaAdacionalTotal2= $datos->cantidad_2 * $piezaAdacionalValor2;
                    $piezaAdacionalEmpresa2= $hoja->piezas_adicionales2;
                    
                }
                if($ing->piezas_adicionales3 == 'NO LLEVA')
                {
                    $piezaAdacionalNom3 ="No Lleva";
                    $piezaAdacionalValor3="&nbsp;";
                    $piezaAdacionalTotal3="&nbsp;";
                    $piezaAdacionalEmpresa3="&nbsp;";
                }else
                {
                    $piezasAdicionales = $this->piezas_adicionales_model->getPiezasAdicionalesPorNombreHojaCosto($ing->piezas_adicionales3);
                    $piezaUnidadVentaNombre3=$piezasAdicionales->unv; //Nombre unidad de venta                                    
                    $piezaAdacionalNom3 = $piezasAdicionales->piezas_adicionales;
                    $piezaAdacionalValor3 =  $piezasAdicionales->valor_venta;
                    $piezaAdacionalTotal3= $datos->cantidad_2 * $piezaAdacionalValor3;;
                    $piezaAdacionalEmpresa3= $hoja->piezas_adicionales3;
                    //echo "<h1>AAAA</h1>".$piezaAdacionalTotal3;
                      //                   exit();
                }
					 if($piezaAdacionalEmpresa1 != 0)
					 {
						$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalEmpresa1;

					 }
					 else
					 {
						$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalTotal1;
						 
					 }
					 
					  if($piezaAdacionalEmpresa2 != 0)
					 {
						$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalEmpresa2;

					 }
					else
					 {
						 $TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalTotal2;
						 
					 }
					 
					 
					  if( $piezaAdacionalEmpresa3 != 0)
					 {
						$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalEmpresa3;

					 }
					else
					 {
						 $TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalTotal3;
						 
					 }
					 
					 $TotalPiezasAdicionales = $piezaAdacionalTotal1 + $piezaAdacionalTotal2 + $piezaAdacionalTotal3;
					 ?>
					 <tr>
                                            <td class="celda_33">PIEZAS ADICIONALES</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($TotalPiezasAdicionales,0,'','.');?></td>
                                        </tr>
					<tr>
                                            <td class="celda_33">VISTO BUENO EN MAQUINA</td>
<!--                                            SI ES SI EN COTIZACION-->
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php if($hoja->valor_bv_maquina == ''){ if ($datos->vb_maquina=="SI") $valor_bv_maquina=100000; else $valor_bv_maquina=0; echo number_format($valor_bv_maquina,0,'','.');}else{echo number_format($hoja->valor_bv_maquina,0,'','.'); $valor_bv_maquina=$hoja->valor_bv_maquina;}?><a href="<?php echo base_url()?>hoja/valores_extras/<?php echo $id?>/2" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="valor_bv_maquina" placeholder="Descripcion técnica" value="<?php echo $hoja->valor_bv_maquina?>" /></td>
                                        </tr>         
					 <tr>
                                            <td class="celda_33">NO ACEPTA EXCEDENTES</td>
<!--                                            SI ES SI EN COTIZACION-->
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php if($hoja->valor_acepeta_exce == ''){ if ($datos->acepta_excedentes=="SI") $valor_acepeta_exce=0; else $valor_acepeta_exce=100000; echo number_format($valor_acepeta_exce,0,'','.');}else{echo number_format($hoja->valor_acepeta_exce,0,'','.'); $valor_acepeta_exce=$hoja->valor_acepeta_exce;}?><a href="<?php echo base_url()?>hoja/valores_extras/<?php echo $id?>/3" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="valor_acepeta_exce" placeholder="Descripcion técnica" value="<?php echo $hoja->valor_acepeta_exce?>" /></td>
                                        </tr>                                        
<?php
                     $totalProduccion2=$costosporlacado2+$complemento+$valorCorte2+$totalEmplacado2+$totalMontajeMolde+$totalTroquelado+$totalPegado+$totalDespacho+$tirajetotal2+$moldeTroquel+$totalDesgajado+$externos_produccion+$otrosCaucho + $TotalPiezasAdicionales + $valor_extra + $valor_bv_maquina + $valor_acepeta_exce;
//                    echo $complemento."<br>";
//                            echo $valorCorte2."<br>";
//                            echo $totalEmplacado2."<br>";
//                            echo $totalMontajeMolde."<br>";
//                            echo $totalTroquelado."<br>";
//                            echo $totalPegado."<br>";
//                            echo $totalDespacho."<br>";
//                            echo $tirajetotal2."<br>";
//                            echo $moldeTroquel."<br>";
//                            echo $totalDesgajado."<br>";
//                            echo $externos_produccion."<br>";
//                            echo $otrosCaucho."<br>";
//                            echo $TotalPiezasAdicionales."<br>";
//                            echo $valor_extra."<br>";
//                            echo $valor_bv_maquina."<br>";
//                            echo $valor_acepeta_exce."<br>";
                     ?>
                     <tr>
                                            <td class="celda_33">TOTAL PRODUCCIÓN</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($totalProduccion2,0,'','.')?></td>
                                        </tr>
                     <tr>
                                            <td class="celda_33">MARGEN</td>
                                            <td class="celda_33">&nbsp;</td>
                                            
                                                <?php
                                        if(sizeof($hoja)==0) { ?>
                                        <td class="celda_3">
                                            <?php $margen= $datos->margen_migrado; echo $margen; ?> </td>
					  <?php } else { ?>
                                        <td class="celda_3">
                                        <?php if($hoja->margen == null)
                                            {$margen=15;echo $margen;}
                                            else{
                                             $margen=$hoja->margen;echo $margen;}?></td>
					<?php }  ?> 
                                            
                                        </tr>
                                        
                                            <td class="celda_33" colspan="3"><hr class="hr_punteada" /></td>
                     </tr>
                     <?php
                     $totalProduccion2=$costosporlacado2+$complemento+$valorCorte2+$totalEmplacado2+$totalMontajeMolde+$totalTroquelado+$totalPegado+$totalDespacho+$tirajetotal2+$moldeTroquel+$totalDesgajado+$externos_produccion+$otrosCaucho + $TotalPiezasAdicionales + $valor_extra + $valor_bv_maquina + $valor_acepeta_exce;
                     $totalProduccion3=$costosporlacado3+$complemento+$valorCorte3+$totalEmplacado3+$totalMontajeMolde+$totalTroquelado+$totalPegado+$totalDespacho+$tirajetotal3+$moldeTroquel+$totalDesgajado+$externos_produccion+$otrosCaucho + $TotalPiezasAdicionales + $valor_extra + $valor_bv_maquina + $valor_acepeta_exce;
                     $totalProduccion4=$costosporlacado4+$complemento+$valorCorte4+$totalEmplacado4+$totalMontajeMolde+$totalTroquelado+$totalPegado+$totalDespacho+$tirajetotal4+$moldeTroquel+$totalDesgajado+$externos_produccion+$otrosCaucho + $TotalPiezasAdicionales + $valor_extra + $valor_bv_maquina + $valor_acepeta_exce;
                     
                     
                     //echo$var=$totalProduccion2+$totalDefi1+$totalPreImpresion;
                      
                     //$totalP2=$complemento+$valorCorte2+$totalEmplacado2+$totalMontajeMolde+$totalTroquelado+$totalPegado+$totalDespacho+$tirajetotal2+$moldeTroquel+$totalDesgajado+$externos_produccion+$otrosCaucho + $TotalPiezasAdicionales + $valor_extra + $valor_bv_maquina + $valor_acepeta_exce+$var;
                     //echo $totalProduccion."<br>";
                    // echo $tirajetotal2;
                    // echo $complemento."<br>";
                    // echo $valorCorte2."<br>";
                    // echo $totalEmplacado2."<br>";
                    // echo $totalMontajeMolde."<br>";
                    // echo $totalTroquelado."<br>";
                    // echo $totalPegado."<br>";
                     //echo $externos_produccion."<br>";
                     //echo $TotalPiezasAdicionales."<br>";
                    // echo $totalDespacho."<br>";
                    // echo $moldeTroquel."<br>";
                    // echo $totalDesgajado."<br>";
                    // echo $otrosCaucho."<br>";
                    // echo $valor_extra."<br>";
                    // echo $valor_bv_maquina."<br>";
                    // echo $valor_acepeta_exce;//
                     //exit();
                     ?>
                     <tr>
                                            <td class="celda_33">TOTAL MATERIA PRIMA CANT 2</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo $totalDef2 ?></td>
                                        </tr>
                     <tr>
                                            <td class="celda_33">TOTAL PRE PRENSA 2</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($totalPreImpresion,0,'','.')?></td>
                                        </tr>
                     <tr>
                                            <td class="celda_33">TOTAL PRODUCCIÓN</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($totalProduccion2,0,'','.')?></td>
                                        </tr>
                     <tr>
                                            <td class="celda_33">TOTAL COSTOS DIRECTOS</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">
                                                <?php echo number_format($totalProduccion2+$totalDefi1+$totalPreImpresion,0,'','.'); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33" colspan="3">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33"><span class="subrayado">COSTOS VARIOS</span></td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">&nbsp;</td>
                     </tr>
                                        
                     <?php
                      //$totalMateriaPrima    
                      $costoVentaValor=(($totalOndaKilo+$totalPlacaKilo+$totalPreImpresion+$totalProduccion)*$costoVenta->precio)/100;
//                      echo  "venta=".$costoVentaValor."=((".$totalOndaKilo."+".$totalPlacaKilo."+".$totalPreImpresion."+".$totalProduccion.")*".$costoVenta->precio.")/100</br>";
                  
                     ?>
                     <tr>
                                            <td class="celda_33">COSTO VENTA</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format((($totalProduccion2+$totalDefi1+$totalPreImpresion)*0.085),0,'','.')?></td>
                     </tr>
                     <?php
                      $costoAdministracionValor=(($totalOndaKilo+$totalPlacaKilo+$totalPreImpresion+$totalProduccion)*$costoAdministracion->precio)/100;
//                      echo "costoadministratuivo=".$costoAdministracionValor."=((".$totalOndaKilo."+".$totalPlacaKilo."+".$totalPreImpresion."+".$totalProduccion.")*".$costoAdministracion->precio.")/100";
                      
                     ?>
                     <tr>
                                            <td class="celda_33">COSTO ADMINISTRACIÓN</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format((($totalProduccion2+$totalDefi1+$totalPreImpresion)*0.085),0,'','.')?></td>
                                        </tr>
<!--                                        <tr>
                                            <td class="celda_33">COSTO ADICIONAL</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php // echo $hoja->costo_adicional?><a href="<?php // echo base_url()?>hoja/costo_adicional/<?php // echo $id?>/<?php // echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php // echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="costo_adicional" value="<?php // echo $hoja->costo_adicional?>" /></td>
                     </tr>-->
					 <tr>
                                            <td class="celda_33">COSTO ADICIONAL</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php if($hoja->valor_extra == ''){ $valor_extra=$datos->varios_migrado; echo number_format($valor_extra,0,'','.');}else{echo number_format($hoja->valor_extra,0,'','.'); $valor_extra=$hoja->valor_extra;}?><a href="<?php echo base_url()?>hoja/valores_extras/<?php echo $id?>/1" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden"  id="valor_extra" name="valor_extra" value="<?php echo $valor_extra; ?>" /></td>
                                        </tr>                           
                     <?php
                      $totalCostosVarios=$costoAdministracionValor+$costoVentaValor+$hoja->costo_adicional+$valor_extra;
                     ?>
                     <tr>
                                            <td class="celda_33">TOTAL COSTOS VARIOS</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format((($totalProduccion2+$totalDefi1+$totalPreImpresion)*0.085)+(($totalProduccion2+$totalDefi1+$totalPreImpresion)*0.085),0,'','.')?></td>
                                        </tr>
                     <tr>
                                            <td class="celda_33">TOTAL FINAL</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format((($totalProduccion2+$totalDefi1+$totalPreImpresion)*0.085)+(($totalProduccion2+$totalDefi1+$totalPreImpresion)*0.085)+($totalProduccion2+$totalDefi1+$totalPreImpresion),0,'','.')?></td>
                                        </tr>
                        <tr>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">&nbsp;</td>
                                          
                                        </tr>
                                        <tr>
                                            <td class="celda_33">PRECIO PARA CANTIDAD 2</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format(((((($totalProduccion2+$totalDefi1+$totalPreImpresion)*0.085)+(($totalProduccion2+$totalDefi1+$totalPreImpresion)*0.085)+($totalProduccion2+$totalDefi1+$totalPreImpresion))/((100-$margen)/100))/$datos->cantidad_2),0,'','.') ?></td>
                                          
                                        </tr>
                                        <tr>
                                            <td class="celda_33">COSTO FINANCIERO <?php echo $forma_pago->forma_pago?> (<?php echo $forma_pago->dias?>)</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format((((($vcostoFinanciero->precio/30)*30)+100)/100)*((((($totalProduccion2+$totalDefi1+$totalPreImpresion)*0.085)+(($totalProduccion2+$totalDefi1+$totalPreImpresion)*0.085)+($totalProduccion2+$totalDefi1+$totalPreImpresion))/((100-$margen)/100))/$datos->cantidad_2),0,'','.') ?></td>
                                          
                                        </tr>
                                    </table>
                        
            <!----------------------------------------------------------->
            <?php
                                $externos_produccion=0;
				if($fotomecanica->acabado_impresion_4=="17")
                                {
                                    $acabado_4="";
                                    $acabado_4Valor="";
                                    $acabado_4MedidaMasValorVenta="";
                                    $acabado_4Unitario="";
                                    $acabado_4UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_4Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_4);
                                    $acabado_4=$acabado_4Array->caracteristicas; // Nombre acabado
                                    $acabado_4UnidadVentaNombre=$acabado_4Array->unv; //Nombre unidad de venta
                                    $acabado_4Valor=$acabado_4Array->valor_venta; // ej: 52
                                    $acabado_4MedidaMasValorVenta=($tamano1*$tamano2*$acabado_4Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_4CostoFijo=$acabado_4Array->costo_fijo;	
                                    
                                    if ($acabado_4Array->unidad_de_venta == '1') //Metros
                                    {
                                        $costo_unitario4=$acabado_4MedidaMasValorVenta;
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_3);
                                        $cantidad_4=$datos->cantidad_3;
                                    }
                                    elseif ($acabado_4Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $costo_unitario4=$acabado_4Valor;
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }  
                                    elseif ($acabado_4Array->unidad_de_venta == '3') //tONELADA
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_3);
                                    }                                    
                                    elseif ($acabado_4Array->unidad_de_venta == '4') //caja de carton
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_3);
                                    }                                            
                                    elseif ($acabado_4Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($datos->cantidad_3*$acabado_4Valor);
                                        $cantidad_4=$datos->cantidad_3;
                                    }       
                                    elseif ($acabado_4Array->unidad_de_venta == '6') //cm2
                                    {
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $costo_unitario4=$acabado_4Valor;     
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }   
                                    elseif ($acabado_4Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario4=$acabado_4MedidaMasValorVenta;
                                        $precio_total_4=$acabado_4MedidaMasValorVenta*$datos->cantidad_3;
                                        $cantidad_4=$datos->cantidad_3;
                                    }
                                    elseif ($acabado_4Array->unidad_de_venta == '8') //cms
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_3);
                                    }           
                                    elseif ($acabado_4Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }     
                                    elseif ($acabado_4Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($acabado_4Valor*$datos->cantidad_3);
                                        $cantidad_4=$datos->cantidad_3;                                        
                                    }                                      
                                }
								
                                if($fotomecanica->acabado_impresion_5=="17")
                                {
                                    $acabado_5="";
                                    $acabado_5Valor="";
                                    $acabado_5MedidaMasValorVenta="";
                                    $acabado_5Unitario="";
                                    $acabado_5UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_5Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_5);
                                    $acabado_5=$acabado_5Array->caracteristicas;
                                    $acabado_5UnidadVentaNombre=$acabado_5Array->unv; //Nombre unidad de venta
                                    $acabado_5Valor=$acabado_5Array->valor_venta; // ej: 52
                                    $acabado_5MedidaMasValorVenta=($tamano1*$tamano2*$acabado_5Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_5CostoFijo=$acabado_5Array->costo_fijo;		
                                  if ($acabado_5Array->unidad_de_venta == '1') //mt2
                                    {
                                        $costo_unitario5=$acabado_5MedidaMasValorVenta;
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_3);                                      
                                        $cantidad_5=$datos->cantidad_3;
                                    }
                                    elseif ($acabado_5Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $costo_unitario5=$acabado_5Valor; 
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }    
                                    elseif ($acabado_5Array->unidad_de_venta == '3') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_3);
                                    }                                    
                                    elseif ($acabado_5Array->unidad_de_venta == '4') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_3);
                                    }                                            
                                    elseif ($acabado_5Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($datos->cantidad_3*$acabado_5Valor);
                                        $cantidad_5=$datos->cantidad_3;
                                    }       
                                    elseif ($acabado_5Array->unidad_de_venta == '6') //mt2
                                    {
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $costo_unitario5=$acabado_5Valor;
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }   
                                    elseif ($acabado_5Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario5=$acabado_5MedidaMasValorVenta;
                                        $precio_total_5=$acabado_5MedidaMasValorVenta*$datos->cantidad_3;
                                        $cantidad_5=$datos->cantidad_3;
                                    }
                                    elseif ($acabado_5Array->unidad_de_venta == '8') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_3);
                                    }           
                                    elseif ($acabado_5Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }   
                                    elseif ($acabado_5Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($acabado_5Valor*$datos->cantidad_3);
                                        $cantidad_5=$datos->cantidad_3;
                                    }                                      
                                }    
                                if($fotomecanica->acabado_impresion_6=="17")
                                {
                                    $acabado_6="";
                                    $acabado_6Valor="";
                                    $acabado_6MedidaMasValorVenta="";
                                    $acabado_6Unitario="";
                                    $acabado_6UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_6Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_6);
                                    $acabado_6=$acabado_6Array->caracteristicas;
                                    $acabado_6UnidadVentaNombre=$acabado_6Array->unv; //Nombre unidad de venta
                                    $acabado_6Valor=$acabado_6Array->valor_venta; // ej: 52
                                    $acabado_6MedidaMasValorVenta=($tamano1*$tamano2*$acabado_6Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_6CostoFijo=$acabado_6Array->costo_fijo;		
                                    if ($acabado_6Array->unidad_de_venta == '1') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_3);
                                    }
                                    elseif ($acabado_6Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $costo_unitario6=$acabado_6Valor; 
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    }  
                                    elseif ($acabado_6Array->unidad_de_venta == '3') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_3);
                                    }                                    
                                    elseif ($acabado_6Array->unidad_de_venta == '4') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_3);
                                    }                                            
                                    elseif ($acabado_6Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($datos->cantidad_3*$acabado_5Valor);
                                        $cantidad_6=$datos->cantidad_3;
                                    }       
                                    elseif ($acabado_6Array->unidad_de_venta == '6') //mt2
                                    {
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $costo_unitario6=$acabado_6Valor;
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    }   
                                    elseif ($acabado_6Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario6=$acabado_6MedidaMasValorVenta;
                                        $precio_total_6=$acabado_6MedidaMasValorVenta*$datos->cantidad_3;
                                        $cantidad_6=$datos->cantidad_3;
                                    }
                                    elseif ($acabado_6Array->unidad_de_venta == '8') //cms
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_3);
                                    }           
                                    elseif ($acabado_6Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    } 
                                    elseif ($acabado_6Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($acabado_6Valor*$datos->cantidad_3);
                                        $cantidad_6=$datos->cantidad_3;
                                    }                                      
									

                                }           
               ?>
            
            <table id="tabla_detalle" style="width: 450px">
                            <tr>
                                <td colspan="3"><hr class="hr_punteada" /></td>
                            </tr>
                            <tr>
                                <td colspan="3"><b>CANTIDAD TRES: <?php echo $datos->cantidad_3 ?> TIRAJE ::: <?php echo $datos->cantidad_3 / $ing->unidades_por_pliego ?></b></td>
                            </tr>
                            <tr>
                                <td colspan="3"><hr class="hr_punteada" /></td>
                            </tr>
                            <tr>
                                <td class="celda_3">PRODUCCIÓN</td>
                                <td class="celda_3">UNITARIO</td>
                                <td class="celda_3">VALOR $</td>
                            </tr>
                            <tr>
                                <td colspan="3"><hr class="hr_punteada" /></td>
                            </tr>
                        <?php
                            if (($datos->cantidad_1>0) and ($ing->unidades_por_pliego>0))
                                $costoPlacaKilo=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                            else 
                                $costoPlacaKilo=0;
                            $valorPlacaKilo=($costoPlacaKilo*$tamano1*$tamano2*$tapaGramaje)/10000000;
                            $totalPlacaKilo=$valorPlacaKilo*$tapaPrecio;
							
                             if(sizeof($hoja)>=1 and $hoja->fecha)
                            {
                                $arreglo5=array
                                (
                                    "placa_kilo"=>$costoPlacaKilo,
                                    "total_pliegos"=>$valorPlacaKilo,
                                );
                                $this->db->where('id', $hoja->id);
                                $this->db->update("hoja_de_costos_datos",$arreglo5);
                            }
			    if(sizeof($hoja)>=1)
                            {
                                $arreglokilo1=array
                                (
                                    "kilos_placa"=>$valorPlacaKilo,
                                 
                                );
                                $this->db->where('id', $hoja->id);
                                $this->db->update("hoja_de_costos_datos",$arreglokilo1);
                            }
                            
       if (($datos->cantidad_3>0) and ($ing->unidades_por_pliego>0))
       {    
           $tiraje=$datos->cantidad_3/$ing->unidades_por_pliego;
       }
       else{
       $tiraje=0;}
       if($tiraje<4000)
       {
         $tiraje2="Menos de 4.000";
         $factor_rangos=$this->variables_cotizador_model->getVariablesCotizadorPorId(17);
         $factor_rango=$factor_rangos->precio;
       }elseif($tiraje>4000 and $tiraje<10000)
       {
         $tiraje2="4.001 a 10.000";
         $factor_rangos=$this->variables_cotizador_model->getVariablesCotizadorPorId(18);
         $factor_rango=$factor_rangos->precio;
       }else
       {
        $tiraje2="Más de 10.000";
        $factor_rangos=$this->variables_cotizador_model->getVariablesCotizadorPorId(19);
        $factor_rango=$factor_rangos->precio;
       }
                        ?>
                        <tr>
                                    <!--producción-->
                                    <table id="tabla_produccion">
                                        <tr>
                                            <td class="celda_33">TIRAJE</td>
                                            <td class="celda_33"><?php echo $factor_rango?></td>
                                            <td class="celda_33"><?php echo number_format($tirajetotal3,0,'','.')?></td>
                                        </tr>
                                  <?php
                                  $variableComplemento=$this->variables_cotizador_model->getVariablesCotizadorPorId(32);
                                        $valorTiraje=$variableComplemento->precio-$tiraje;
										
                                        if($valorTiraje>0)
                                        {
                                            if($fotomecanica->colores == 0)
                                            {
                                              $complemento=0;
                                            }else{
                                              $complemento=$valorTiraje;	
                                            }
                                            
											
                                        }else
                                        {
                                            $complemento=0;
                                        }
                                        
                                        
                                  ?>  
					<?php if($hoja->valor_externo!=0){ $externos_produccion=$externos_produccion+$hoja->valor_externo; }else{  $externos_produccion=$precio_total_4+$precio_total_5+$precio_total_6; } ?>			  

								  
                    <tr>
                                            <td class="celda_33">COMPLEMENTO</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($complemento,0,'','.')?></td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33">EXTERNOS</td>
                                            <td class="celda_33">&nbsp;</td>

                                            <td class="celda_33"><?php echo number_format($externos_produccion,0,'','.');?></td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33">COSTOS POR LACADO</td>
                                            <td class="celda_33">&nbsp;</td>

                                            <td class="celda_33"><?php echo number_format($costosporlacado3,0,'','.');?></td>
                                        </tr>
                    <?php
                        if($maquina=="Máquina Roland 800")
                        {
                           if (($datos->cantidad_1>0) and ($ing->unidades_por_pliego>0))
                                $costoOndaKilo=((($datos->cantidad_1/$ing->unidades_por_pliego)*1.04)+100)+4;
                            else 
                                $costoOndaKilo=0;                            
                        }else
                        {
                           if (($datos->cantidad_1>0) and ($ing->unidades_por_pliego>0))
                                $costoOndaKilo=(($datos->cantidad_1/$ing->unidades_por_pliego)+100)+4;
                            else 
                                $costoOndaKilo=0;                               
                        }
                        
                        if($fotomecanica->materialidad_datos_tecnicos == 'Sólo Cartulina')
                        {
                                $costoOndaKilo=0;
                                $valorOndaKilo=0;
                                $totalOndaKilo=0;
                                $valorCorte=0;

                        }else{
                            $valorOndaKilo=($costoOndaKilo*$tamano1*$tamano2*$GramosMetroCuadrado)/10000000;
                            $totalOndaKilo=$valorOndaKilo*$costo_kilo;
                            $valorCorte=$costoOndaKilo*4.5;
			}
                        
                        $costoOndaKilo1=((($datos->cantidad_1/$ing->unidades_por_pliego)*1.04)+100)+4;
                        $costoOndaKilo2=(($datos->cantidad_1/$ing->unidades_por_pliego)+$emplacado+$troquelado);
                        
                        if($costoOndaKilo1>$costoOndaKilo2){
                            $costoOndaKilo=$costoOndaKilo1;
                        }
                        if($costoOndaKilo1<$costoOndaKilo2){
                            $costoOndaKilo=$costoOndaKilo2;
                        }
                        
                    ?>
                    <tr>
                            <td class="celda_33">CORTE</td>
                            <td class="celda_33">4.5</td>
                            <td class="celda_33"><?php echo number_format($valorCorte3,0,'','.')?></td>
                    </tr>
                    <?php
                        $variableEmplacado=$this->variables_cotizador_model->getVariablesCotizadorPorId(8);
                        $valorEmplacadado=($variableEmplacado->precio*$tamano1*$tamano2)/10000;
                        $totalEmplacado=$valorEmplacadado*$costoOndaKilo;
                    ?>
                    <tr>
                        <td class="celda_33">EMPLACADO</td>
                        <td class="celda_33"><?php echo $valorEmplacadado?></td>
                        <td class="celda_33"><?php echo number_format($totalEmplacado3,0,'','.')?></td>
                    </tr>
                    <?php
                    
                        if($fotomecanica->estan_los_moldes == 'NO LLEVA')
                        {
                            $variableMontajeMoldeTroquel=0;
                            $totalMontajeMolde=0;
                        }else
                        {
                            $variableRecargoMontaje=$this->variables_cotizador_model->getVariablesCotizadorPorId(31);
                            $variableMontajeMoldeTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(10);
                            $totalMontajeMolde=$variableMontajeMoldeTroquel->precio*1.5;	
                        }                    

//                   
                    ?>
                    <tr>
                                            <td class="celda_33">MONTAJE MOLDE</td>
                                            <td class="celda_33"><?php echo number_format($variableMontajeMoldeTroquel->precio,0,'','.')?></td>
                                            <td class="celda_33"><?php echo number_format($totalMontajeMolde,0,'','.')?></td>
                                        </tr>
                    <?php
						if($fotomecanica->estan_los_moldes == 'NO LLEVA')
						{
                                                    $variableTroquelado=0;
                                                    $totalTroquelado=0;
						}else
						{
                                                    $variableTroquelado=$this->variables_cotizador_model->getVariablesCotizadorPorId(11);
                                                    $totalTroquelado=($costoOnda3*$variableTroquelado->precio)*1.5;	
						}                    
//						
                    ?>
                    <tr>
                                            <td class="celda_33">TROQUELADO</td>
                                            <td class="celda_33"><?php echo $variableTroquelado->precio?></td>
                                            <td class="celda_33"><?php echo number_format($totalTroquelado,0,'','.')?></td>
                    </tr>
                    <?php
                                        $variableDesgajado=$this->variables_cotizador_model->getVariablesCotizadorPorId(12);
                                        $totalDesgajado=$ing->piezas_totales_en_el_pliego*$variableDesgajado->precio*1.5*$costoOnda3;
                    ?>
                    <tr>
                                            <td class="celda_33">DESGAJADO (<?php echo "Piezas totales: ".$ing->piezas_totales_en_el_pliego;?>)</td>
                                            <td class="celda_33"><?php echo $variableDesgajado->precio?></td>
                                            <td class="celda_33"><?php echo number_format($totalDesgajado,0,'','.')?></td>
                    </tr>
                    <?php
//                                        
                    ?>
                     <tr>
                                            <td class="celda_33">PEGADO</td>
                                        <?php
                                        if(sizeof($hoja)==0) { 
                                                $variablePegado=$this->variables_cotizador_model->getVariablesCotizadorPorId(21);
                                                if ($datos->pegado_migrado==null) $pegado_migrado=1; else $pegado_migrado=$datos->pegado_migrado;
                                                $totalPegado=$datos->cantidad_3*$pegado_migrado*$variablePegado->precio;                                               
                                          ?>
                                                <td class="celda_33"><?php if($datos->pegado_migrado == ''){echo '30';}else{echo $datos->pegado_migrado;}?><a href="<?php echo base_url()?>hoja/pegado/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="pegado" placeholder="Descripcion técnica" value="<?php echo $datos->pegado_migrado?>" /></td>
					  <?php } else { 
                                                $variablePegado=$this->variables_cotizador_model->getVariablesCotizadorPorId(21);
                                                $totalPegado=$datos->cantidad_3*$hoja->pegado*$variablePegado->precio;                                              
                                          ?>
                                                <td class="celda_33"><?php if($hoja->pegado == ''){echo '30';}else{echo $hoja->pegado;}?><a href="<?php echo base_url()?>hoja/pegado/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="pegado" placeholder="Descripcion técnica" value="<?php echo $hoja->pegado?>" /></td>
					<?php }  ?>                                            
                                            
<!--                                            <td class="celda_33"><?php // if($hoja->pegado == ''){echo '30';}else{echo $hoja->pegado;}?><a href="<?php // echo base_url()?>hoja/pegado/<?php // echo $id?>/<?php // echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php // echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="pegado" placeholder="Descripcion técnica" value="<?php // echo $hoja->pegado?>" /></td>-->
                                                <td class="celda_33"><?php echo number_format($totalPegado,0,'','.')?><?php if ($datos->pegado_migrado==null){?> <strong> (Pegado de Cotizacion = 0 )</strong><?php } ?> </td> 
											
											
                     </tr>
                     <?php
					 if(sizeof($hoja->pegado)>=1)
					 {
                                            $divisionPegado=$hoja->pegado/2;
                                            $totalDespacho=$divisionPegado*$datos->cantidad_3;
					 }
					 else
					 {
                                             if ($datos->pegado_migrado=='')
                                                $divisionPegado=$presupuesto->costo_pegado/2;
                                             else
                                                $divisionPegado=$datos->pegado_migrado/2;
                                             $totalDespacho=$divisionPegado*$datos->cantidad_3;	 
					 }
					 
					 
                     
                     ?>
                     <tr>
                                            <td class="celda_33">DESPACHO</td>
                                            <td class="celda_33"><?php echo $divisionPegado?></td>
                                            <td class="celda_33"><?php echo number_format($totalDespacho,0,'','.')?></td>
                     </tr>
                     <?php
					 
					 	
					 
					 //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
					 
                    if($fotomecanica->condicion_del_producto == 'Nuevo') //nuevo 
                    {
                        if($fotomecanica->estan_los_moldes == 'NO')
			{
				$variableTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(9);
                                $moldeTroquel=$variableTroquel->precio;
                        }
                        elseif($fotomecanica->estan_los_moldes == 'NO LLEVA')
                        {
                            $moldeTroquel=0;
                        }elseif($fotomecanica->estan_los_moldes == 'CLIENTE LO APORTA')
                        {
                            $moldeTroquel=0;
                        }
                    }
                    if($fotomecanica->condicion_del_producto == 'Repetición Sin Cambios') //
                    {
//                        if($fotomecanica->estan_los_moldes == 'SI')
//			{
//				$variableTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(9);
//                                $moldeTroquel=$variableTroquel->precio;
//                        }
                    if($fotomecanica->estan_los_moldes == 'NO LLEVA')
                    {
                            $variableTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(9);
                            $moldeTroquel=$variableTroquel->precio;
                    }
                    }					
                    if($fotomecanica->condicion_del_producto == 'Repetición con Cambios') //
                    {
			$moldeTroquel=0;
                    }
                    if($fotomecanica->condicion_del_producto == 'Producto Genérico') //
                    {
			$moldeTroquel=0;
                    }
                    // $moldeTroquel=0;
                    //$variableTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(9);
                    //$moldeTroquel=$variableTroquel->precio;
                                            
									   
                     ?>
                     <tr>
                                            <td class="celda_33">MOLDE TROQUEL</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($moldeTroquel,0,'','.');?></td>
                                            <!-- <td class="celda_33"><?php //if($datos->condicion_del_producto=='Repetición Sin Cambios'){echo '0';}else{echo number_format($moldeTroquel,0,'','.');}?></td> -->
                     </tr>
					 <?php
					 $variableEmplacado=$this->variables_cotizador_model->getVariablesCotizadorPorId(39);
					 if($fotomecanica->lleva_barniz == 'SI' and $fotomecanica->reserva_barniz == 'SI')
					 {
						 $otrosCaucho = $variableEmplacado->precio; 
					 }else
					 {
						$otrosCaucho = 0;
					 }
					 
					 ?>
					 <tr>
                                            <td class="celda_33">CAUCHO</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($otrosCaucho,0,'','.');?></td>
                                            
                       
                     </tr>
					 <?php
					
                                        
                if($ing->piezas_adicionales == 'NO LLEVA')
                {
                    $piezaAdacionalNom1 ="No Lleva";
                    $piezaAdacionalValor1="&nbsp;";
                    $piezaAdacionalTotal1="&nbsp;";
                    $piezaAdacionalEmpresa1="&nbsp;";
                }else
                {
                    $piezasAdicionales = $this->piezas_adicionales_model->getPiezasAdicionalesPorNombreHojaCosto($ing->piezas_adicionales);
                    $piezaUnidadVentaNombre1=$piezasAdicionales->unv; //Nombre unidad de venta
                    $piezaAdacionalNom1 = $piezasAdicionales->piezas_adicionales;
                    $piezaAdacionalValor1= $piezasAdicionales->valor_venta;
                    $piezaAdacionalTotal1 = $datos->cantidad_3 * $piezaAdacionalValor1;
                    $piezaAdacionalEmpresa1= $hoja->piezas_adicionales1;
                     
                }
                if($ing->piezas_adicionales2 == 'NO LLEVA')
                {
                    $piezaAdacionalNom2 ="No Lleva";
                    $piezaAdacionalValor2="&nbsp;";
                    $piezaAdacionalTotal2="&nbsp;";
                    $piezaAdacionalEmpresa2="&nbsp;";
                }else
                {
                    $piezasAdicionales = $this->piezas_adicionales_model->getPiezasAdicionalesPorNombreHojaCosto($ing->piezas_adicionales2);
                    $piezaUnidadVentaNombre2=$piezasAdicionales->unv; //Nombre unidad de venta                                    
                    $piezaAdacionalNom2 = $piezasAdicionales->piezas_adicionales;
                    $piezaAdacionalValor2= $piezasAdicionales->valor_venta;
                    $piezaAdacionalTotal2= $datos->cantidad_3 * $piezaAdacionalValor2;
                    $piezaAdacionalEmpresa2= $hoja->piezas_adicionales2;
                    
                }
                if($ing->piezas_adicionales3 == 'NO LLEVA')
                {
                    $piezaAdacionalNom3 ="No Lleva";
                    $piezaAdacionalValor3="&nbsp;";
                    $piezaAdacionalTotal3="&nbsp;";
                    $piezaAdacionalEmpresa3="&nbsp;";
                }else
                {
                    $piezasAdicionales = $this->piezas_adicionales_model->getPiezasAdicionalesPorNombreHojaCosto($ing->piezas_adicionales3);
                    $piezaUnidadVentaNombre3=$piezasAdicionales->unv; //Nombre unidad de venta                                    
                    $piezaAdacionalNom3 = $piezasAdicionales->piezas_adicionales;
                    $piezaAdacionalValor3 =  $piezasAdicionales->valor_venta;
                    $piezaAdacionalTotal3= $datos->cantidad_3 * $piezaAdacionalValor3;;
                    $piezaAdacionalEmpresa3= $hoja->piezas_adicionales3;
                    //echo "<h1>AAAA</h1>".$piezaAdacionalTotal3;
                      //                   exit();
                }
					 if($piezaAdacionalEmpresa1 != 0)
					 {
						$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalEmpresa1;

					 }
					 else
					 {
						$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalTotal1;
						 
					 }
					 
					  if($piezaAdacionalEmpresa2 != 0)
					 {
						$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalEmpresa2;

					 }
					else
					 {
						 $TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalTotal2;
						 
					 }
					 
					 
					  if( $piezaAdacionalEmpresa3 != 0)
					 {
						$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalEmpresa3;

					 }
					else
					 {
						 $TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalTotal3;
						 
					 }
					 
					 $TotalPiezasAdicionales = $piezaAdacionalTotal1 + $piezaAdacionalTotal2 + $piezaAdacionalTotal3;
					 ?>
					 <tr>
                                            <td class="celda_33">PIEZAS ADICIONALES</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($TotalPiezasAdicionales,0,'','.');?></td>
                                        </tr>
					<tr>
                                            <td class="celda_33">VISTO BUENO EN MAQUINA</td>
<!--                                            SI ES SI EN COTIZACION-->
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php if($hoja->valor_bv_maquina == ''){ if ($datos->vb_maquina=="SI") $valor_bv_maquina=100000; else $valor_bv_maquina=0; echo number_format($valor_bv_maquina,0,'','.');}else{echo number_format($hoja->valor_bv_maquina,0,'','.'); $valor_bv_maquina=$hoja->valor_bv_maquina;}?><a href="<?php echo base_url()?>hoja/valores_extras/<?php echo $id?>/2" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="valor_bv_maquina" placeholder="Descripcion técnica" value="<?php echo $hoja->valor_bv_maquina?>" /></td>
                                        </tr>         
					 <tr>
                                            <td class="celda_33">NO ACEPTA EXCEDENTES</td>
<!--                                            SI ES SI EN COTIZACION-->
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php if($hoja->valor_acepeta_exce == ''){ if ($datos->acepta_excedentes=="SI") $valor_acepeta_exce=0; else $valor_acepeta_exce=100000; echo number_format($valor_acepeta_exce,0,'','.');}else{echo number_format($hoja->valor_acepeta_exce,0,'','.'); $valor_acepeta_exce=$hoja->valor_acepeta_exce;}?><a href="<?php echo base_url()?>hoja/valores_extras/<?php echo $id?>/3" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="valor_acepeta_exce" placeholder="Descripcion técnica" value="<?php echo $hoja->valor_acepeta_exce?>" /></td>
                                        </tr>                                        
                     <?php
                        $totalProduccion3=$costosporlacado3+$complemento+$valorCorte3+$totalEmplacado3+$totalMontajeMolde+$totalTroquelado+$totalPegado+$totalDespacho+$tirajetotal3+$moldeTroquel+$totalDesgajado+$externos_produccion+$otrosCaucho + $TotalPiezasAdicionales + $valor_extra + $valor_bv_maquina + $valor_acepeta_exce;
                        ?>
                                        <tr>
                                            <td class="celda_33">TOTAL PRODUCCIÓN</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($totalProduccion3,0,'','.')?></td>
                                        </tr>

                                            <td class="celda_33" colspan="3"><hr class="hr_punteada" /></td>
                     </tr>
                    
                     <?php
                        $totalProduccion3=$costosporlacado3+$complemento+$valorCorte3+$totalEmplacado3+$totalMontajeMolde+$totalTroquelado+$totalPegado+$totalDespacho+$tirajetotal3+$moldeTroquel+$totalDesgajado+$externos_produccion+$otrosCaucho + $TotalPiezasAdicionales + $valor_extra + $valor_bv_maquina + $valor_acepeta_exce;
                        ?>
                     <tr>
                                            <td class="celda_33">TOTAL MATERIA PRIMA CANT 3</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo $totalDef3 ?></td>
                                        </tr>
                     <tr>
                                            <td class="celda_33">TOTAL PRE PRENSA 3</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($totalPreImpresion,0,'','.')?></td>
                                        </tr>
                     <tr>
                                            <td class="celda_33">TOTAL PRODUCCIÓN</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($totalProduccion3,0,'','.')?></td>
                                        </tr>
                     <tr>
                                            <td class="celda_33">TOTAL COSTOS DIRECTOS</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">
                                                <?php echo number_format($totalProduccion3+$totalDefi2+$totalPreImpresion,0,'','.'); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33" colspan="3">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33"><span class="subrayado">COSTOS VARIOS</span></td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">&nbsp;</td>
                     </tr>
                     <?php
                      //$totalMateriaPrima    
                      $costoVentaValor=(($totalOndaKilo+$totalPlacaKilo+$totalPreImpresion+$totalProduccion)*$costoVenta->precio)/100;
//                      echo  "venta=".$costoVentaValor."=((".$totalOndaKilo."+".$totalPlacaKilo."+".$totalPreImpresion."+".$totalProduccion.")*".$costoVenta->precio.")/100</br>";
                  
                     ?>
                     <tr>
                                            <td class="celda_33">COSTO VENTA</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format((($totalProduccion3+$totalDefi2+$totalPreImpresion)*0.085),0,'','.')?></td>
                     </tr>
                     <?php
                      $costoAdministracionValor=(($totalOndaKilo+$totalPlacaKilo+$totalPreImpresion+$totalProduccion)*$costoAdministracion->precio)/100;
//                      echo "costoadministratuivo=".$costoAdministracionValor."=((".$totalOndaKilo."+".$totalPlacaKilo."+".$totalPreImpresion."+".$totalProduccion.")*".$costoAdministracion->precio.")/100";
                      
                     ?>
                     <tr>
                                            <td class="celda_33">COSTO ADMINISTRACIÓN</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format((($totalProduccion3+$totalDefi2+$totalPreImpresion)*0.085),0,'','.')?></td>
                                        </tr>
<!--                                        <tr>
                                            <td class="celda_33">COSTO ADICIONAL</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php // echo $hoja->costo_adicional?><a href="<?php // echo base_url()?>hoja/costo_adicional/<?php // echo $id?>/<?php // echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php // echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="costo_adicional" value="<?php // echo $hoja->costo_adicional?>" /></td>
                     </tr>-->
					 <tr>
                                            <td class="celda_33">COSTO ADICIONAL</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php if($hoja->valor_extra == ''){ $valor_extra=$datos->varios_migrado; echo number_format($valor_extra,0,'','.');}else{echo number_format($hoja->valor_extra,0,'','.'); $valor_extra=$hoja->valor_extra;}?><a href="<?php echo base_url()?>hoja/valores_extras/<?php echo $id?>/1" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden"  id="valor_extra" name="valor_extra" value="<?php echo $valor_extra; ?>" /></td>
                                        </tr>                           
                     <?php
                      $totalCostosVarios=$costoAdministracionValor+$costoVentaValor+$hoja->costo_adicional+$valor_extra;
                     ?>
                     <tr>
                                            <td class="celda_33">TOTAL COSTOS VARIOS</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format((($totalProduccion3+$totalDefi2+$totalPreImpresion)*0.085)+(($totalProduccion3+$totalDefi2+$totalPreImpresion)*0.085),0,'','.')?></td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33">TOTAL FINAL</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format((($totalProduccion3+$totalDefi2+$totalPreImpresion)*0.085)+(($totalProduccion3+$totalDefi2+$totalPreImpresion)*0.085)+($totalProduccion3+$totalDefi2+$totalPreImpresion),0,'','.')?></td>
                                        </tr>
                        <tr>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">&nbsp;</td>
                                          
                                        </tr>
                                        <?php //echo "<h1>".$totalProduccion3."</h1>" ?>
                                        <?php //echo "<h1>".$totalProduccion3."</h1>" ?>
                                        <?php //echo "<h1>".$totalProduccion3."</h1>" ?>
                                        <?php //echo "<h1>".$totalProduccion3."</h1>" ?>
                                        <?php //echo "<h1>".$totalProduccion3."</h1>" ?>
                                        <tr>
                                            <td class="celda_33">PRECIO PARA CANTIDAD 3</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format(((((($totalProduccion3+$totalDefi2+$totalPreImpresion)*0.085)+(($totalProduccion3+$totalDefi2+$totalPreImpresion)*0.085)+($totalProduccion3+$totalDefi2+$totalPreImpresion))/((100-$margen)/100))/$datos->cantidad_3),0,'','.') ?></td>
                                          
                                        </tr>
                                        <tr>
                                            <td class="celda_33">COSTO FINANCIERO <?php echo $forma_pago->forma_pago?> (<?php echo $forma_pago->dias?>)</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format((((($vcostoFinanciero->precio/30)*30)+100)/100)*((((($totalProduccion3+$totalDefi2+$totalPreImpresion)*0.085)+(($totalProduccion3+$totalDefi2+$totalPreImpresion)*0.085)+($totalProduccion3+$totalDefi2+$totalPreImpresion))/((100-$margen)/100))/$datos->cantidad_3),0,'','.') ?></td>
                                          
                                        </tr>
                                    </table>
            <!----------------------------------------------------------->
            <?php
                                $externos_produccion=0;
				if($fotomecanica->acabado_impresion_4=="17")
                                {
                                    $acabado_4="";
                                    $acabado_4Valor="";
                                    $acabado_4MedidaMasValorVenta="";
                                    $acabado_4Unitario="";
                                    $acabado_4UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_4Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_4);
                                    $acabado_4=$acabado_4Array->caracteristicas; // Nombre acabado
                                    $acabado_4UnidadVentaNombre=$acabado_4Array->unv; //Nombre unidad de venta
                                    $acabado_4Valor=$acabado_4Array->valor_venta; // ej: 52
                                    $acabado_4MedidaMasValorVenta=($tamano1*$tamano2*$acabado_4Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_4CostoFijo=$acabado_4Array->costo_fijo;	
                                    
                                    if ($acabado_4Array->unidad_de_venta == '1') //Metros
                                    {
                                        $costo_unitario4=$acabado_4MedidaMasValorVenta;
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_4);
                                        $cantidad_4=$datos->cantidad_4;
                                    }
                                    elseif ($acabado_4Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $costo_unitario4=$acabado_4Valor;
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }  
                                    elseif ($acabado_4Array->unidad_de_venta == '3') //tONELADA
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_4);
                                    }                                    
                                    elseif ($acabado_4Array->unidad_de_venta == '4') //caja de carton
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_4);
                                    }                                            
                                    elseif ($acabado_4Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($datos->cantidad_4*$acabado_4Valor);
                                        $cantidad_4=$datos->cantidad_4;
                                    }       
                                    elseif ($acabado_4Array->unidad_de_venta == '6') //cm2
                                    {
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $costo_unitario4=$acabado_4Valor;     
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }   
                                    elseif ($acabado_4Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario4=$acabado_4MedidaMasValorVenta;
                                        $precio_total_4=$acabado_4MedidaMasValorVenta*$datos->cantidad_4;
                                        $cantidad_4=$datos->cantidad_4;
                                    }
                                    elseif ($acabado_4Array->unidad_de_venta == '8') //cms
                                    {
                                        $precio_total_4=($acabado_4MedidaMasValorVenta*$datos->cantidad_4);
                                    }           
                                    elseif ($acabado_4Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($acabado_4Valor*$fotomecanica->input_variable_externo_4);
                                        $cantidad_4=$fotomecanica->input_variable_externo_4;
                                    }     
                                    elseif ($acabado_4Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario4=$acabado_4Valor;                                        
                                        $precio_total_4=($acabado_4Valor*$datos->cantidad_4);
                                        $cantidad_4=$datos->cantidad_4;                                        
                                    }                                      
                                }
								
                                if($fotomecanica->acabado_impresion_5=="17")
                                {
                                    $acabado_5="";
                                    $acabado_5Valor="";
                                    $acabado_5MedidaMasValorVenta="";
                                    $acabado_5Unitario="";
                                    $acabado_5UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_5Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_5);
                                    $acabado_5=$acabado_5Array->caracteristicas;
                                    $acabado_5UnidadVentaNombre=$acabado_5Array->unv; //Nombre unidad de venta
                                    $acabado_5Valor=$acabado_5Array->valor_venta; // ej: 52
                                    $acabado_5MedidaMasValorVenta=($tamano1*$tamano2*$acabado_5Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_5CostoFijo=$acabado_5Array->costo_fijo;		
                                  if ($acabado_5Array->unidad_de_venta == '1') //mt2
                                    {
                                        $costo_unitario5=$acabado_5MedidaMasValorVenta;
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_4);                                      
                                        $cantidad_5=$datos->cantidad_4;
                                    }
                                    elseif ($acabado_5Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $costo_unitario5=$acabado_5Valor; 
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }    
                                    elseif ($acabado_5Array->unidad_de_venta == '3') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_4);
                                    }                                    
                                    elseif ($acabado_5Array->unidad_de_venta == '4') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_4);
                                    }                                            
                                    elseif ($acabado_5Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($datos->cantidad_4*$acabado_5Valor);
                                        $cantidad_5=$datos->cantidad_4;
                                    }       
                                    elseif ($acabado_5Array->unidad_de_venta == '6') //mt2
                                    {
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $costo_unitario5=$acabado_5Valor;
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }   
                                    elseif ($acabado_5Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario5=$acabado_5MedidaMasValorVenta;
                                        $precio_total_5=$acabado_5MedidaMasValorVenta*$datos->cantidad_4;
                                        $cantidad_5=$datos->cantidad_4;
                                    }
                                    elseif ($acabado_5Array->unidad_de_venta == '8') //mt2
                                    {
                                        $precio_total_5=($acabado_5MedidaMasValorVenta*$datos->cantidad_4);
                                    }           
                                    elseif ($acabado_5Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($acabado_5Valor*$fotomecanica->input_variable_externo_5);
                                        $cantidad_5=$fotomecanica->input_variable_externo_5;
                                    }   
                                    elseif ($acabado_5Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario5=$acabado_5Valor;                                        
                                        $precio_total_5=($acabado_5Valor*$datos->cantidad_4);
                                        $cantidad_5=$datos->cantidad_4;
                                    }                                      
                                }    
                                if($fotomecanica->acabado_impresion_6=="17")
                                {
                                    $acabado_6="";
                                    $acabado_6Valor="";
                                    $acabado_6MedidaMasValorVenta="";
                                    $acabado_6Unitario="";
                                    $acabado_6UnidadVentaNombre="";
                                }else
                                {
                                    $acabado_6Array=$this->acabados_model->getAcabadosPorId($fotomecanica->acabado_impresion_6);
                                    $acabado_6=$acabado_6Array->caracteristicas;
                                    $acabado_6UnidadVentaNombre=$acabado_6Array->unv; //Nombre unidad de venta
                                    $acabado_6Valor=$acabado_6Array->valor_venta; // ej: 52
                                    $acabado_6MedidaMasValorVenta=($tamano1*$tamano2*$acabado_6Valor)/10000; // (ancho x largo x valor venta) /10000									
                                    $acabado_6CostoFijo=$acabado_6Array->costo_fijo;		
                                    if ($acabado_6Array->unidad_de_venta == '1') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_4);
                                    }
                                    elseif ($acabado_6Array->unidad_de_venta == '2') //Kilos
                                    {
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $costo_unitario6=$acabado_6Valor; 
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    }  
                                    elseif ($acabado_6Array->unidad_de_venta == '3') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_4);
                                    }                                    
                                    elseif ($acabado_6Array->unidad_de_venta == '4') //mt2
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_4);
                                    }                                            
                                    elseif ($acabado_6Array->unidad_de_venta == '5') //unidad
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($datos->cantidad_4*$acabado_5Valor);
                                        $cantidad_6=$datos->cantidad_4;
                                    }       
                                    elseif ($acabado_6Array->unidad_de_venta == '6') //mt2
                                    {
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $costo_unitario6=$acabado_6Valor;
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    }   
                                    elseif ($acabado_6Array->unidad_de_venta == '7') //mt2
                                    {
                                        $costo_unitario6=$acabado_6MedidaMasValorVenta;
                                        $precio_total_6=$acabado_6MedidaMasValorVenta*$datos->cantidad_4;
                                        $cantidad_6=$datos->cantidad_4;
                                    }
                                    elseif ($acabado_6Array->unidad_de_venta == '8') //cms
                                    {
                                        $precio_total_6=($acabado_6MedidaMasValorVenta*$datos->cantidad_4);
                                    }           
                                    elseif ($acabado_6Array->unidad_de_venta == '9') //Monto Fijo 
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($acabado_6Valor*$fotomecanica->input_variable_externo_6);
                                        $cantidad_6=$fotomecanica->input_variable_externo_6;
                                    } 
                                    elseif ($acabado_6Array->unidad_de_venta == '10') //Por Pasada 
                                    {
                                        $costo_unitario6=$acabado_6Valor;                                        
                                        $precio_total_6=($acabado_6Valor*$datos->cantidad_4);
                                        $cantidad_6=$datos->cantidad_4;
                                    }                                      
									

                                }           
               ?>
            <table id="tabla_detalle" style="width: 450px">
                            <tr>
                                <td colspan="3"><hr class="hr_punteada" /></td>
                            </tr>
                            <tr>
                                <td colspan="3"><b>CANTIDAD CUATRO: <?php echo $datos->cantidad_4 ?> TIRAJE::: <?php echo $datos->cantidad_4 / $ing->unidades_por_pliego ?></b></td>
                            </tr>
                            <tr>
                                <td colspan="3"><hr class="hr_punteada" /></td>
                            </tr>
                            <tr>
                                <td class="celda_3">PRODUCCIÓN</td>
                                <td class="celda_3">UNITARIO</td>
                                <td class="celda_3">VALOR $</td>
                            </tr>
                            <tr>
                                <td colspan="3"><hr class="hr_punteada" /></td>
                            </tr>
                        <?php
                            if (($datos->cantidad_1>0) and ($ing->unidades_por_pliego>0))
                                $costoPlacaKilo=($datos->cantidad_1/$ing->unidades_por_pliego)+$sum;
                            else 
                                $costoPlacaKilo=0;
                            $valorPlacaKilo=($costoPlacaKilo*$tamano1*$tamano2*$tapaGramaje)/10000000;
                            $totalPlacaKilo=$valorPlacaKilo*$tapaPrecio;
							
                             if(sizeof($hoja)>=1 and $hoja->fecha)
                            {
                                $arreglo5=array
                                (
                                    "placa_kilo"=>$costoPlacaKilo,
                                    "total_pliegos"=>$valorPlacaKilo,
                                );
                                $this->db->where('id', $hoja->id);
                                $this->db->update("hoja_de_costos_datos",$arreglo5);
                            }
			    if(sizeof($hoja)>=1)
                            {
                                $arreglokilo1=array
                                (
                                    "kilos_placa"=>$valorPlacaKilo,
                                 
                                );
                                $this->db->where('id', $hoja->id);
                                $this->db->update("hoja_de_costos_datos",$arreglokilo1);
                            }
                            
                            if (($datos->cantidad_4 > 0) and ( $ing->unidades_por_pliego > 0)) {
    $tiraje = $datos->cantidad_4 / $ing->unidades_por_pliego;
} else {
    $tiraje = 0;
}
if ($tiraje < 4000) {
    $tiraje2 = "Menos de 4.000";
    $factor_rangos = $this->variables_cotizador_model->getVariablesCotizadorPorId(17);
    $factor_rango = $factor_rangos->precio;
} elseif ($tiraje > 4000 and $tiraje < 10000) {
    $tiraje2 = "4.001 a 10.000";
    $factor_rangos = $this->variables_cotizador_model->getVariablesCotizadorPorId(18);
    $factor_rango = $factor_rangos->precio;
} else {
    $tiraje2 = "Más de 10.000";
    $factor_rangos = $this->variables_cotizador_model->getVariablesCotizadorPorId(19);
    $factor_rango = $factor_rangos->precio;
}
?>
                        <tr>
                                    <!--producción-->
                                    <table id="tabla_produccion">
                                        <tr>
                                            <td class="celda_33">TIRAJE</td>
                                            <td class="celda_33"><?php echo $factor_rango?></td>
                                            <td class="celda_33"><?php echo number_format($tirajetotal4,0,'','.')?></td>
                                        </tr>
                                  <?php
                                  $variableComplemento=$this->variables_cotizador_model->getVariablesCotizadorPorId(32);
                                        $valorTiraje=$variableComplemento->precio-$tiraje;
										
                                        if($valorTiraje>0)
                                        {
                                            if($fotomecanica->colores == 0)
                                            {
                                              $complemento=0;
                                            }else{
                                              $complemento=$valorTiraje;	
                                            }
                                            
											
                                        }else
                                        {
                                            $complemento=0;
                                        }
                                        
                                        
                                  ?>  
					<?php if($hoja->valor_externo!=0){ $externos_produccion=$externos_produccion+$hoja->valor_externo; }else{  $externos_produccion=$precio_total_4+$precio_total_5+$precio_total_6; } ?>			  

								  
                    <tr>
                                            <td class="celda_33">COMPLEMENTO</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($complemento,0,'','.')?></td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33">EXTERNOS</td>
                                            <td class="celda_33">&nbsp;</td>

                                            <td class="celda_33"><?php echo number_format($externos_produccion,0,'','.');?></td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33">COSTOS POR LACADO</td>
                                            <td class="celda_33">&nbsp;</td>

                                            <td class="celda_33"><?php echo number_format($costosporlacado4,0,'','.');?></td>
                                        </tr>
                    <?php
                        if($maquina=="Máquina Roland 800")
                        {
                           if (($datos->cantidad_1>0) and ($ing->unidades_por_pliego>0))
                                $costoOndaKilo=((($datos->cantidad_1/$ing->unidades_por_pliego)*1.04)+100)+4;
                            else 
                                $costoOndaKilo=0;                            
                        }else
                        {
                           if (($datos->cantidad_1>0) and ($ing->unidades_por_pliego>0))
                                $costoOndaKilo=(($datos->cantidad_1/$ing->unidades_por_pliego)+100)+4;
                            else 
                                $costoOndaKilo=0;                               
                        }
                        
                        if($fotomecanica->materialidad_datos_tecnicos == 'Sólo Cartulina')
                        {
                                $costoOndaKilo=0;
                                $valorOndaKilo=0;
                                $totalOndaKilo=0;
                                $valorCorte=0;

                        }else{
                            $valorOndaKilo=($costoOndaKilo*$tamano1*$tamano2*$GramosMetroCuadrado)/10000000;
                            $totalOndaKilo=$valorOndaKilo*$costo_kilo;
                            $valorCorte=$costoOndaKilo*4.5;
			}
                        
                        $costoOndaKilo1=((($datos->cantidad_1/$ing->unidades_por_pliego)*1.04)+100)+4;
                        $costoOndaKilo2=(($datos->cantidad_1/$ing->unidades_por_pliego)+$emplacado+$troquelado);
                        
                        if($costoOndaKilo1>$costoOndaKilo2){
                            $costoOndaKilo=$costoOndaKilo1;
                        }
                        if($costoOndaKilo1<$costoOndaKilo2){
                            $costoOndaKilo=$costoOndaKilo2;
                        }
                        
                    ?>
                    <tr>
                            <td class="celda_33">CORTE</td>
                            <td class="celda_33">4.5</td>
                            <td class="celda_33"><?php echo number_format($valorCorte4,0,'','.')?></td>
                    </tr>
                    <?php
                        $variableEmplacado=$this->variables_cotizador_model->getVariablesCotizadorPorId(8);
                        $valorEmplacadado=($variableEmplacado->precio*$tamano1*$tamano2)/10000;
                        $totalEmplacado=$valorEmplacadado*$costoOndaKilo;
                    ?>
                    <tr>
                        <td class="celda_33">EMPLACADO</td>
                        <td class="celda_33"><?php echo $valorEmplacadado?></td>
                        <td class="celda_33"><?php echo number_format($totalEmplacado4,0,'','.')?></td>
                    </tr>
                    <?php
                    
                        if($fotomecanica->estan_los_moldes == 'NO LLEVA')
                        {
                            $variableMontajeMoldeTroquel=0;
                            $totalMontajeMolde=0;
                        }else
                        {
                            $variableRecargoMontaje=$this->variables_cotizador_model->getVariablesCotizadorPorId(31);
                            $variableMontajeMoldeTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(10);
                            $totalMontajeMolde=$variableMontajeMoldeTroquel->precio*1.5;	
                        }                    

//                        if($fotomecanica->estan_los_moldes == 'NO' or $fotomecanica->estan_los_moldes == 'SI')
//                        {
//                            $variableRecargoMontaje=$this->variables_cotizador_model->getVariablesCotizadorPorId(31);
//                            $variableMontajeMoldeTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(10);
//                            $totalMontajeMolde=$variableMontajeMoldeTroquel->precio*1.5;	
//                        }elseif($fotomecanica->estan_los_moldes == 'NO LLEVA')
//                        {
//                            $variableMontajeMoldeTroquel=0;
//                            $totalMontajeMolde=0;
//                        }elseif($fotomecanica->estan_los_moldes == 'CLIENTE LO APORTA')
//                        {
//                            $variableRecargoMontaje=$this->variables_cotizador_model->getVariablesCotizadorPorId(31);
//                            $variableMontajeMoldeTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(10);
//                            $totalMontajeMolde=$variableMontajeMoldeTroquel->precio*1.5;	
//                        }

                    ?>
                    <tr>
                                            <td class="celda_33">MONTAJE MOLDE</td>
                                            <td class="celda_33"><?php echo number_format($variableMontajeMoldeTroquel->precio,0,'','.')?></td>
                                            <td class="celda_33"><?php echo number_format($totalMontajeMolde,0,'','.')?></td>
                                        </tr>
                    <?php
						if($fotomecanica->estan_los_moldes == 'NO LLEVA')
						{
                                                    $variableTroquelado=0;
                                                    $totalTroquelado=0;
						}else
						{
                                                    $variableTroquelado=$this->variables_cotizador_model->getVariablesCotizadorPorId(11);
                                                    $totalTroquelado=($costoOnda4*$variableTroquelado->precio)*1.5;	
						}                    
//						
                    ?>
                    <tr>
                                            <td class="celda_33">TROQUELADO</td>
                                            <td class="celda_33"><?php echo $variableTroquelado->precio?></td>
                                            <td class="celda_33"><?php echo number_format($totalTroquelado,0,'','.')?></td>
                    </tr>
                    <?php
                                        $variableDesgajado=$this->variables_cotizador_model->getVariablesCotizadorPorId(12);
                                        $totalDesgajado=$ing->piezas_totales_en_el_pliego*$variableDesgajado->precio*1.5*$costoOnda4;
                    ?>
                    <tr>
                                            <td class="celda_33">DESGAJADO (<?php echo "Piezas totales: ".$ing->piezas_totales_en_el_pliego;?>)</td>
                                            <td class="celda_33"><?php echo $variableDesgajado->precio?></td>
                                            <td class="celda_33"><?php echo number_format($totalDesgajado,0,'','.')?></td>
                    </tr>
                    <tr>
                                            <td class="celda_33">PEGADO</td>
                                        <?php
                                        if(sizeof($hoja)==0) { 
                                                $variablePegado=$this->variables_cotizador_model->getVariablesCotizadorPorId(21);
                                                if ($datos->pegado_migrado==null) $pegado_migrado=1; else $pegado_migrado=$datos->pegado_migrado;
                                                $totalPegado=$datos->cantidad_4*$pegado_migrado*$variablePegado->precio;                                               
                                          ?>
                                                <td class="celda_33"><?php if($datos->pegado_migrado == ''){echo '30';}else{echo $datos->pegado_migrado;}?><a href="<?php echo base_url()?>hoja/pegado/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="pegado" placeholder="Descripcion técnica" value="<?php echo $datos->pegado_migrado?>" /></td>
					  <?php } else { 
                                                $variablePegado=$this->variables_cotizador_model->getVariablesCotizadorPorId(21);
                                                $totalPegado=$datos->cantidad_4*$hoja->pegado*$variablePegado->precio;                                              
                                          ?>
                                                <td class="celda_33"><?php if($hoja->pegado == ''){echo '30';}else{echo $hoja->pegado;}?><a href="<?php echo base_url()?>hoja/pegado/<?php echo $id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="pegado" placeholder="Descripcion técnica" value="<?php echo $hoja->pegado?>" /></td>
					<?php }  ?>                                            
                                            
<!--                                            <td class="celda_33"><?php // if($hoja->pegado == ''){echo '30';}else{echo $hoja->pegado;}?><a href="<?php // echo base_url()?>hoja/pegado/<?php // echo $id?>/<?php // echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php // echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="pegado" placeholder="Descripcion técnica" value="<?php // echo $hoja->pegado?>" /></td>-->
                                                <td class="celda_33"><?php echo number_format($totalPegado,0,'','.')?><?php if ($datos->pegado_migrado==null){?> <strong> (Pegado de Cotizacion = 0 )</strong><?php } ?> </td> 
											
											
                     </tr>
                     <?php
					 if(sizeof($hoja->pegado)>=1)
					 {
                                            $divisionPegado=$hoja->pegado/2;
                                            $totalDespacho=$divisionPegado*$datos->cantidad_4;
					 }
					 else
					 {
                                             if ($datos->pegado_migrado=='')
                                                $divisionPegado=$presupuesto->costo_pegado/2;
                                             else
                                                $divisionPegado=$datos->pegado_migrado/2;
                                             $totalDespacho=$divisionPegado*$datos->cantidad_4;	 
					 }
					 
					 
                     
                     ?>
                     <tr>
                                            <td class="celda_33">DESPACHO</td>
                                            <td class="celda_33"><?php echo $divisionPegado?></td>
                                            <td class="celda_33"><?php echo number_format($totalDespacho,0,'','.')?></td>
                     </tr>
                     <?php
					 
					 	
					 
					 //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
					 
                    if($fotomecanica->condicion_del_producto == 'Nuevo') //nuevo 
                    {
                        if($fotomecanica->estan_los_moldes == 'NO')
			{
				$variableTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(9);
                                $moldeTroquel=$variableTroquel->precio;
                        }
                        elseif($fotomecanica->estan_los_moldes == 'NO LLEVA')
                        {
                            $moldeTroquel=0;
                        }elseif($fotomecanica->estan_los_moldes == 'CLIENTE LO APORTA')
                        {
                            $moldeTroquel=0;
                        }
                    }
                    if($fotomecanica->condicion_del_producto == 'Repetición Sin Cambios') //
                    {
//                        if($fotomecanica->estan_los_moldes == 'SI')
//			{
//				$variableTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(9);
//                                $moldeTroquel=$variableTroquel->precio;
//                        }
                    if($fotomecanica->estan_los_moldes == 'NO LLEVA')
                    {
                            $variableTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(9);
                            $moldeTroquel=$variableTroquel->precio;
                    }
                    }					
                    if($fotomecanica->condicion_del_producto == 'Repetición con Cambios') //
                    {
			$moldeTroquel=0;
                    }
                    if($fotomecanica->condicion_del_producto == 'Producto Genérico') //
                    {
			$moldeTroquel=0;
                    }
                    // $moldeTroquel=0;
                    //$variableTroquel=$this->variables_cotizador_model->getVariablesCotizadorPorId(9);
                    //$moldeTroquel=$variableTroquel->precio;
                                            
									   
                     ?>
                     <tr>
                                            <td class="celda_33">MOLDE TROQUEL</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($moldeTroquel,0,'','.');?></td>
                                            <!-- <td class="celda_33"><?php //if($datos->condicion_del_producto=='Repetición Sin Cambios'){echo '0';}else{echo number_format($moldeTroquel,0,'','.');}?></td> -->
                     </tr>
					 <?php
					 $variableEmplacado=$this->variables_cotizador_model->getVariablesCotizadorPorId(39);
					 if($fotomecanica->lleva_barniz == 'SI' and $fotomecanica->reserva_barniz == 'SI')
					 {
						 $otrosCaucho = $variableEmplacado->precio; 
					 }else
					 {
						$otrosCaucho = 0;
					 }
					 
					 ?>
					 <tr>
                                            <td class="celda_33">CAUCHO</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($otrosCaucho,0,'','.');?></td>
                                            
                       
                     </tr>
					 <?php
					 
                                        
                if($ing->piezas_adicionales == 'NO LLEVA')
                {
                    $piezaAdacionalNom1 ="No Lleva";
                    $piezaAdacionalValor1="&nbsp;";
                    $piezaAdacionalTotal1="&nbsp;";
                    $piezaAdacionalEmpresa1="&nbsp;";
                }else
                {
                    $piezasAdicionales = $this->piezas_adicionales_model->getPiezasAdicionalesPorNombreHojaCosto($ing->piezas_adicionales);
                    $piezaUnidadVentaNombre1=$piezasAdicionales->unv; //Nombre unidad de venta
                    $piezaAdacionalNom1 = $piezasAdicionales->piezas_adicionales;
                    $piezaAdacionalValor1= $piezasAdicionales->valor_venta;
                    $piezaAdacionalTotal1 = $datos->cantidad_4 * $piezaAdacionalValor1;
                    $piezaAdacionalEmpresa1= $hoja->piezas_adicionales1;
                     
                }
                if($ing->piezas_adicionales2 == 'NO LLEVA')
                {
                    $piezaAdacionalNom2 ="No Lleva";
                    $piezaAdacionalValor2="&nbsp;";
                    $piezaAdacionalTotal2="&nbsp;";
                    $piezaAdacionalEmpresa2="&nbsp;";
                }else
                {
                    $piezasAdicionales = $this->piezas_adicionales_model->getPiezasAdicionalesPorNombreHojaCosto($ing->piezas_adicionales2);
                    $piezaUnidadVentaNombre2=$piezasAdicionales->unv; //Nombre unidad de venta                                    
                    $piezaAdacionalNom2 = $piezasAdicionales->piezas_adicionales;
                    $piezaAdacionalValor2= $piezasAdicionales->valor_venta;
                    $piezaAdacionalTotal2= $datos->cantidad_4 * $piezaAdacionalValor2;
                    $piezaAdacionalEmpresa2= $hoja->piezas_adicionales2;
                    
                }
                if($ing->piezas_adicionales3 == 'NO LLEVA')
                {
                    $piezaAdacionalNom3 ="No Lleva";
                    $piezaAdacionalValor3="&nbsp;";
                    $piezaAdacionalTotal3="&nbsp;";
                    $piezaAdacionalEmpresa3="&nbsp;";
                }else
                {
                    $piezasAdicionales = $this->piezas_adicionales_model->getPiezasAdicionalesPorNombreHojaCosto($ing->piezas_adicionales3);
                    $piezaUnidadVentaNombre3=$piezasAdicionales->unv; //Nombre unidad de venta                                    
                    $piezaAdacionalNom3 = $piezasAdicionales->piezas_adicionales;
                    $piezaAdacionalValor3 =  $piezasAdicionales->valor_venta;
                    $piezaAdacionalTotal3= $datos->cantidad_4 * $piezaAdacionalValor3;;
                    $piezaAdacionalEmpresa3= $hoja->piezas_adicionales3;
                    //echo "<h1>AAAA</h1>".$piezaAdacionalTotal3;
                      //                   exit();
                }
					 if($piezaAdacionalEmpresa1 != 0)
					 {
						$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalEmpresa1;

					 }
					 else
					 {
						$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalTotal1;
						 
					 }
					 
					  if($piezaAdacionalEmpresa2 != 0)
					 {
						$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalEmpresa2;

					 }
					else
					 {
						 $TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalTotal2;
						 
					 }
					 
					 
					  if( $piezaAdacionalEmpresa3 != 0)
					 {
						$TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalEmpresa3;

					 }
					else
					 {
						 $TotalPiezasAdicionales = $TotalPiezasAdicionales + $piezaAdacionalTotal3;
						 
					 }
					 
					 $TotalPiezasAdicionales = $piezaAdacionalTotal1 + $piezaAdacionalTotal2 + $piezaAdacionalTotal3;
                                         ?>
					 <tr>
                                            <td class="celda_33">PIEZAS ADICIONALES</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($TotalPiezasAdicionales,0,'','.');?></td>
                                        </tr>
					<tr>
                                            <td class="celda_33">VISTO BUENO EN MAQUINA</td>
<!--                                            SI ES SI EN COTIZACION-->
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php if($hoja->valor_bv_maquina == ''){ if ($datos->vb_maquina=="SI") $valor_bv_maquina=100000; else $valor_bv_maquina=0; echo number_format($valor_bv_maquina,0,'','.');}else{echo number_format($hoja->valor_bv_maquina,0,'','.'); $valor_bv_maquina=$hoja->valor_bv_maquina;}?><a href="<?php echo base_url()?>hoja/valores_extras/<?php echo $id?>/2" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="valor_bv_maquina" placeholder="Descripcion técnica" value="<?php echo $hoja->valor_bv_maquina?>" /></td>
                                        </tr>         
					 <tr>
                                            <td class="celda_33">NO ACEPTA EXCEDENTES</td>
<!--                                            SI ES SI EN COTIZACION-->
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php if($hoja->valor_acepeta_exce == ''){ if ($datos->acepta_excedentes=="SI") $valor_acepeta_exce=0; else $valor_acepeta_exce=100000; echo number_format($valor_acepeta_exce,0,'','.');}else{echo number_format($hoja->valor_acepeta_exce,0,'','.'); $valor_acepeta_exce=$hoja->valor_acepeta_exce;}?><a href="<?php echo base_url()?>hoja/valores_extras/<?php echo $id?>/3" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="valor_acepeta_exce" placeholder="Descripcion técnica" value="<?php echo $hoja->valor_acepeta_exce?>" /></td>
                     <?php
                    // $totalProduccion=$complemento+$valorCorte+$totalEmplacado+$totalMontajeMolde+$totalTroquelado+$totalPegado+$totalDespacho+$tiraje+$moldeTroquel+$totalDesgajado+$externos_produccion+$otrosCaucho + $TotalPiezasAdicionales + $valor_extra + $valor_bv_maquina + $valor_acepeta_exce;
                      $totalProduccion4=$costosporlacado4+$complemento+$valorCorte4+$totalEmplacado4+$totalMontajeMolde+$totalTroquelado+$totalPegado+$totalDespacho+$tirajetotal4+$moldeTroquel+$totalDesgajado+$externos_produccion+$otrosCaucho + $TotalPiezasAdicionales + $valor_extra + $valor_bv_maquina + $valor_acepeta_exce;
                     ?>
                                         <tr>
                                            <td class="celda_33">TOTAL PRODUCCIÓN</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($totalProduccion4,0,'','.')?></td>
                                        </tr>
                                        </tr>                                        

                                            <td class="celda_33" colspan="3"><hr class="hr_punteada" /></td>
                     </tr>
                     <?php
                    // $totalProduccion=$complemento+$valorCorte+$totalEmplacado+$totalMontajeMolde+$totalTroquelado+$totalPegado+$totalDespacho+$tiraje+$moldeTroquel+$totalDesgajado+$externos_produccion+$otrosCaucho + $TotalPiezasAdicionales + $valor_extra + $valor_bv_maquina + $valor_acepeta_exce;
                      $totalProduccion4=$costosporlacado4+$complemento+$valorCorte4+$totalEmplacado4+$totalMontajeMolde+$totalTroquelado+$totalPegado+$totalDespacho+$tirajetotal4+$moldeTroquel+$totalDesgajado+$externos_produccion+$otrosCaucho + $TotalPiezasAdicionales + $valor_extra + $valor_bv_maquina + $valor_acepeta_exce;
                     ?>
                     <tr>
                                            <td class="celda_33">TOTAL MATERIA PRIMA CANT 4</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo $totalDef4 ?></td>
                                        </tr>
                     <tr>
                                            <td class="celda_33">TOTAL PRE PRENSA 4</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($totalPreImpresion,0,'','.')?></td>
                                        </tr>
                     <tr>
                                            <td class="celda_33">TOTAL PRODUCCIÓN</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format($totalProduccion4,0,'','.')?></td>
                                        </tr>
                     <tr>
                                            <td class="celda_33">TOTAL COSTOS DIRECTOS</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">
                                                <?php echo number_format($totalProduccion4+$totalDefi3+$totalPreImpresion,0,'','.'); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33" colspan="3">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td class="celda_33"><span class="subrayado">COSTOS VARIOS</span></td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">&nbsp;</td>
                     </tr>
                     <?php
                      //$totalMateriaPrima    
                      $costoVentaValor=(($totalOndaKilo+$totalPlacaKilo+$totalPreImpresion+$totalProduccion)*$costoVenta->precio)/100;
//                      echo  "venta=".$costoVentaValor."=((".$totalOndaKilo."+".$totalPlacaKilo."+".$totalPreImpresion."+".$totalProduccion.")*".$costoVenta->precio.")/100</br>";
                  
                     ?>
                     <tr>
                                            <td class="celda_33">COSTO VENTA</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format((($totalProduccion4+$totalDefi3+$totalPreImpresion)*0.085),0,'','.')?></td>
                     </tr>
                     <?php
                      $costoAdministracionValor=(($totalOndaKilo+$totalPlacaKilo+$totalPreImpresion+$totalProduccion)*$costoAdministracion->precio)/100;
//                      echo "costoadministratuivo=".$costoAdministracionValor."=((".$totalOndaKilo."+".$totalPlacaKilo."+".$totalPreImpresion."+".$totalProduccion.")*".$costoAdministracion->precio.")/100";
                      
                     ?>
                     <tr>
                                            <td class="celda_33">COSTO ADMINISTRACIÓN</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format((($totalProduccion4+$totalDefi3+$totalPreImpresion)*0.085),0,'','.')?></td>
                                        </tr>
<!--                                        <tr>
                                            <td class="celda_33">COSTO ADICIONAL</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php // echo $hoja->costo_adicional?><a href="<?php // echo base_url()?>hoja/costo_adicional/<?php // echo $id?>/<?php // echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php // echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden" name="costo_adicional" value="<?php // echo $hoja->costo_adicional?>" /></td>
                     </tr>-->
					 <tr>
                                            <td class="celda_33">COSTO ADICIONAL</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php if($hoja->valor_extra == ''){ $valor_extra=$datos->varios_migrado; echo number_format($valor_extra,0,'','.');}else{echo number_format($hoja->valor_extra,0,'','.'); $valor_extra=$hoja->valor_extra;}?><a href="<?php echo base_url()?>hoja/valores_extras/<?php echo $id?>/1" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" class="img_16" /></a><input type="hidden"  id="valor_extra" name="valor_extra" value="<?php echo $valor_extra; ?>" /></td>
                                        </tr>                           
                     <?php
                      $totalCostosVarios=$costoAdministracionValor+$costoVentaValor+$hoja->costo_adicional+$valor_extra;
                     ?>
                     <tr>
                                            <td class="celda_33">TOTAL COSTOS VARIOS</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format((($totalProduccion4+$totalDefi3+$totalPreImpresion)*0.085)+(($totalProduccion4+$totalDefi3+$totalPreImpresion)*0.085),0,'','.')?></td>
                                        </tr>
                                         <tr>
                                            <td class="celda_33">TOTAL FINAL</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format((($totalProduccion4+$totalDefi3+$totalPreImpresion)*0.085)+(($totalProduccion4+$totalDefi3+$totalPreImpresion)*0.085)+($totalProduccion4+$totalDefi3+$totalPreImpresion),0,'','.')?></td>
                                        </tr>
                        <tr>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33">&nbsp;</td>
                                          
                                        </tr>
                                        <?php //echo "<h1>".$totalProduccion3."</h1>" ?>
                                        <?php //echo "<h1>".$totalProduccion3."</h1>" ?>
                                        <?php //echo "<h1>".$totalProduccion3."</h1>" ?>
                                        <?php //echo "<h1>".$totalProduccion3."</h1>" ?>
                                        <?php //echo "<h1>".$totalProduccion3."</h1>" ?>
                                        <tr>
                                            <td class="celda_33">PRECIO PARA CANTIDAD 4</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format(((((($totalProduccion4+$totalDefi3+$totalPreImpresion)*0.085)+(($totalProduccion4+$totalDefi3+$totalPreImpresion)*0.085)+($totalProduccion4+$totalDefi3+$totalPreImpresion))/((100-$margen)/100))/$datos->cantidad_4),0,'','.') ?></td>
                                          
                                        </tr>
                                        <tr>
                                            <td class="celda_33">COSTO FINANCIERO <?php echo $forma_pago->forma_pago?> (<?php echo $forma_pago->dias?>)</td>
                                            <td class="celda_33">&nbsp;</td>
                                            <td class="celda_33"><?php echo number_format((((($vcostoFinanciero->precio/30)*30)+100)/100)*((((($totalProduccion4+$totalDefi3+$totalPreImpresion)*0.085)+(($totalProduccion4+$totalDefi3+$totalPreImpresion)*0.085)+($totalProduccion4+$totalDefi3+$totalPreImpresion))/((100-$margen)/100))/$datos->cantidad_4),0,'','.') ?></td>
                                          
                                        </tr>
                                    </table>
            <!----------------------------------------------------------->
            <nav class="derecha">
                <ul id="menuhorizontal">
                    <?php 
					$hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
					if(sizeof($hoja) >= 1){
					?>
                     <li><a href="<?php echo base_url();?>cotizaciones/pdf/<?php echo $id?>" target="_blank" title="Exportar a PDF"><img src="<?php echo base_url();?>public/frontend/images/pdf.png" /> </li>
					<?php }?> 
                     <li><a href="<?php echo base_url();?>hoja/cambios/<?php echo $id?>" class="fancybox fancybox.ajax" title="Registro de cambios"><img src="<?php echo base_url();?>public/frontend/images/cambios.png" /> </li>
                     <li><a href="<?php echo base_url();?>cotizaciones/cotizacion_de_cliente/<?php echo $id?>" target="_blank" title="Cotización Cliente"><img src="<?php echo base_url();?>public/frontend/images/document.png" /> </li>
                     <li><a href="javascript:void(0);" onclick="guardarHC()" title="Guardar y Liberar"><img src="<?php echo base_url();?>public/frontend/images/save.png" /><input type="hidden" name="id" value="<?php echo $id?>" /><input type="hidden" name="url" value="<?php echo base_url()?><?php echo $this->uri->uri_string();?>" /> </li>
                     <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>"  title="Volver a Cotización"><img src="<?php echo base_url();?>public/frontend/images/back.png" /> </li>
                </ul>
                </nav>
                
        </div>
		
		<?php
		//Calculo para las demas cantidades
		//$prueba = $this->cotizaciones_model->CantidadPorXXX($id,$datos->cantidad_2);
		//echo $prueba;
		?>
		
		
		
        <script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/chosen.jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/prism.js"></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
</form>
        <!--</page>-->
    </body>
</html>  