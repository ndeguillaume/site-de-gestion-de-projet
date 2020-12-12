<div class="task-information hidden" >
   <div>
      <h3 class="task-information-id">Tâche <span class="task-id"></span></h3>
   </div>
   <div>
      <h3>Titre</h3>
      <textarea maxlength="255" id="title" class="task-information-title" onkeydown="textAreaAdjust(this)"></textarea>
   </div>
   <div>
      <h3>Description</h3>
      <textarea maxlength="1000" id="description" class="task-information-description" onkeydown="textAreaAdjust(this)" style="overflow:hidden">></textarea>
   </div>
   <div>
      <h3>Definition of done</h3>
      <textarea maxlength="255" id="dod" class="task-information-dod" onkeydown="textAreaAdjust(this)" style="overflow:hidden">></textarea>
   </div>
   <div>
      <h3>Durée</h3>
      <input id="cost" class="task-information-cost" type="number" min="1" max="8" onkeydown="return false" >
   </div>
   <div>
      <h3>Tâches parentes</h3>
         <select id="related-tasks-dropdown" class="selectpicker related-tasks-dropdown" multiple>
         </select>
   </div>
   <div>
      <h3>Issues</h3>
         <select id="related-issues-dropdown" class="selectpicker related-issues-dropdown" multiple>
         </select>
   </div>
   <div class="button-wrapper">
   </div>
</div>  