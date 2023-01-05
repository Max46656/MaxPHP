  function delAll() {
    console.log('delAll');
    if (confirm('\\n是否要刪除所有勾選資料？\\n刪除後無法恢復！\\n')) {
      <input type="hidden" name="action" value="delete"></input>
      formR.submit();
    } else {
      return false;
    }
  }
