/**
 * Contact Store
 */

Ext.define('ExtjsMVC.store.Contacts', {
    extend: 'Ext.data.Store',
    model: 'ExtjsMVC.model.Contact',
    id:     'contactStore',
    autoLoad: true,
    pageSize: 20, // items per page
    
    proxy: {  
        type: 'direct',
        directFn: Contacts.getAll,
        reader: {
            root: 'contacts',
            totalProperty: 'total'
        }
      
    }
    
});