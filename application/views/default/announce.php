<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel"><?=$modules->fe_announce->name?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideModal();">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <?=$modules->fe_announce->text?>
         </div>
      </div>
   </div>
</div>
<script>
   function showModal() {
     var modal = document.getElementById('myModal');
     modal.classList.add('show');
     modal.style.display = 'block';
   }
			document.addEventListener('DOMContentLoaded', function() {
     showModal();
   });

   function hideModal() {
     var modal = document.getElementById('myModal');
     modal.classList.remove('show');
     modal.style.display = 'none';
   }   
</script>
