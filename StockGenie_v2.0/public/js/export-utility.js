// export-utils.js
function exportColumns(dataTable, type) {
    var clonedTable = new $.fn.dataTable.Api(dataTable.settings().init()); // Create a new DataTable instance
    
    // Get the visible columns
    var visibleColumns = dataTable.columns(':visible').indexes().toArray();
    
    // Filter out action and image columns if present
    var filteredColumns = visibleColumns.filter(function(index) {
        var column = dataTable.column(index);
        var columnData = column.data();
        if (columnData.some(function(cellData) {
            return cellData.includes('<img') || cellData.includes('fa-'); // Check for image or action icons
        })) {
            return false; // Exclude columns with images or action icons
        }
        return true;
    });
    
    // Hide columns not included in filteredColumns
    var hiddenColumns = dataTable.columns().indexes().toArray().filter(function(index) {
        return filteredColumns.indexOf(index) === -1;
    });
    clonedTable.columns(hiddenColumns).visible(false);
    
    // Trigger the export action
    clonedTable.buttons.exportData({ modifier: { selected: true } }, type);
}
