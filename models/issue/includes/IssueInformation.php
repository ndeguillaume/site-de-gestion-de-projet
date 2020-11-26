<div class="issue-information hidden" >
   <div>
      <h3 class="issue-information-id">Issue <span class="issue-id"></span></h3>
   </div>
   <div>
      <h3>Titre</h3>
      <textarea maxlength="255" class="issue-information-title" onkeydown="textAreaAdjust(this)"></textarea>
   </div>
   <div>
      <h3>Description</h3>
      <textarea maxlength="1000" class="issue-information-description" onkeydown="textAreaAdjust(this)" style="overflow:hidden"></textarea>
   </div>
   <div>
      <h3>Coût</h3>
      <input class="issue-information-cost" type="number" min="1">
   </div>
   <div>
      <h3>Priorité</h3>
      <form>
         <select class="issue-information-priority">
            <option value="lowest">La plus basse</option>
            <option value="low">Basse</option>
            <option value="medium" selected>Moyenne</option>
            <option value="high">Haute</option>
            <option value="highest">La plus haute</option>
         </select>
      </form>
   </div>
   <div class="button-wrapper">
   </div>
</div>