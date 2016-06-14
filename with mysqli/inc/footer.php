
			</div>
		</div>
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>
	<script>
		$('.collapse').collapse({
			toggle: true
		});
		$("input[type='checkbox']").on("change", function(){
			if($(this).prop("checked")){
				$(this).parent().find(".thumbnail").addClass("active");
			}else{
				$(this).parent().find(".thumbnail").removeClass("active");
			}
		});
	</script>
  </body>
</html>