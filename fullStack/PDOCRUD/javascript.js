  function delAll() {
    console.log('delAll');
    if (confirm('\\n是否要刪除這筆資料?\\n刪除後無法恢復!\\n')) {
      formR.submit();
    } else {
      return false;
    }
  }
