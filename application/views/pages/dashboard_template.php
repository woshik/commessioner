<div class="container-fluid">
	<div class="row">
		<div class="outer-w3-agile col-xl">

			<div class="stat-grid p-3 d-flex align-items-center justify-content-between bg-primary">
		        <div class="s-l">
		            <h5>মোট মামলা দায়ের</h5>
		        </div>
		        <div class="s-r">
		            <h6><?php 
		            	if($totalMamla == 0){
		            		echo "০";
		            	}else{
		            		echo convertToeng($totalMamla);
		            	} 
		            	?>টি
		                <i class="far fa-edit"></i>
		            </h6>
		        </div>
		    </div>

		    <div class="stat-grid p-3 mt-3 d-flex align-items-center justify-content-between bg-success">
		        <div class="s-l">
		            <h5>আজকের দায়ের মামলা</h5>
		        </div>
		        <div class="s-r">
		            <h6>
		            	<?php 
		            	if($todayMamla == 0){
		            		echo "০";
		            	}else{
		            		echo convertToeng($todayMamla);
		            	}
		            	?>টি
		                <i class="far fa-smile"></i>
		            </h6>
		        </div>
		    </div>

		    <div class="stat-grid p-3 mt-3 d-flex align-items-center justify-content-between bg-danger">
		        <div class="s-l">
		            <h5>ব্যালেস</h5>
		        </div>
		        <div class="s-r">
		            <h6>
		            	<?php
		            		$value = explode("||",$balance);

							if ((int)$value[0] != 1912) {
								$balance = (double) $balance;
								if (gettype($balance)=='integer' || gettype($balance)=='double' && gettype($balance)!='string') 
								{
									
								}
								else{
									$balance = 0;
								}
								$balance = number_format($balance, 2, '.', '');
								$tk = convertToeng($balance);
								echo $tk.'৳';
							}
							else{
								$balance = 0;
								echo '০৳';
							} 
						?>
		                <i class="fas fa-tasks"></i>
		            </h6>
		        </div>
		    </div>

		    <div class="stat-grid p-3 mt-3 d-flex align-items-center justify-content-between bg-success">
		        <div class="s-l">
		            <h5>এস.এম.এস আছে</h5>
		        </div>
		        <div class="s-r">
		            <h6>
		            	<?php 
		            	if($balance == 0){
		            		echo "০";
		            	}else{
		            		echo convertToeng((int) ($balance/.40));
		            	}
		            	?>টি
		                <i class="fas fa-users"></i>
		            </h6>
		        </div>
		    </div>

		    <div class="stat-grid p-3 mt-3 d-flex align-items-center justify-content-between bg-primary">
		        <div class="s-l">
		            <h5>এস.এম.এস দরকার</h5>
		        </div>
		        <div class="s-r">
		            <h6>
		        		<?php 
		        		if($smsPending == 0){
		        			echo "০";
		        		}else{
		        			echo convertToeng($smsPending);
		        		} 
		        		?>টি
		                <i class="fas fa-users"></i>
		            </h6>
		        </div>
		    </div>

		</div>

		<!-- Calender -->
		<div class="outer-w3-agile col-xl ml-xl-3 mt-xl-0 mt-3">
		    <h4 class="tittle-w3-agileits mb-2">ক্যালেন্ডার</h4>
				<div class="calender"></div>
		</div>
		<!--// Calender -->
	</div>
</div>
  	
<?php 
	function convertToeng($eng=null)
	{
		if ($eng) {
			$bangla_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
    		$eng_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0"); 
    		$bangla = str_replace($eng_array, $bangla_array, $eng);

			return $bangla;
		}
	}
?>