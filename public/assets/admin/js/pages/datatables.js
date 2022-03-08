var DataTables = (function () {
  var handleTables = function () {
    $('#default-datatable').DataTable()

    $('#responsive-datatable').DataTable({
      responsive: true,
      order: [[ 1, "asc" ]]
    })

    $('#dashboard-new-customers-datatable').DataTable({
      responsive:true,
      order: [[ 1, "asc" ]]
    })
    $('#dashboard-new-orders-datatable').DataTable({
      responsive:true,
      order: [[ 1, "asc" ]]
    })
  }

  return {
    // main function to initiate the module
    init: function () {
      handleTables()
    }
  }
})()

jQuery(document).ready(function () {
  DataTables.init()
})
