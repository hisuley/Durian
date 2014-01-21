<form role="form" method="POST">
  <div class="form-group">
    <label for="inputParentId">父级</label>
    <select class="form-control" name="AddressForm[parent_id]">
       <option value="">无</option>
       <?php 
       foreach($parentList as $value){
        echo "<option value='".$value->id."'>".$value->name."</option>";
       }
       ?>
    </select>
  </div>
  <div class="form-group">
    <label for="inputCountry">名字</label>
    <input type="text" name="AddressForm[name]" class="form-control" id="inputCountry" >
  </div>
  <div class="form-group">
    <label>备注</label>
    <textarea name="AddressForm[notes]"></textarea>
  </div>
  <button type="submit" class="btn btn-default">提交</button>
</form>