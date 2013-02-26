/**
 * Contact List
 * @alias contactlist
 */
Ext.define('ExtjsMVC.view.contact.ContactList' ,{
    extend: 'Ext.grid.Panel',
    alias : 'widget.contactlist',
    id : 'contactListGrid',
    store: 'Contacts',
    autoScroll: true,
    border: false,
    minHeight: 300,
    
    viewConfig: {
        /* This is the message that will be shown when the store is empty */
        emptyText: '<div class="centered-panel"><div class="grid-empty-message">'+locale.contactlist.emptyMessagge+'</div></div>'
    },
    requires:['Ext.selection.CheckboxModel'],
    dockedItems: [{
        xtype: 'pagingtoolbar',
        store: 'Contacts',   // same store GridPanel is using
        beforePageText : locale.contactlist.page,
        afterPageText: locale.contactlist.of + ' {0}',
        dock: 'bottom',
        displayInfo: true,
        displayMsg: locale.contactlist.displaying + ' {0} - {1} ' +locale.contactlist.of + ' {2}'
    }],
    
    initComponent: function() {
        
        this.tbar = this.createToolbar();
                    
        this.columns = [
        {
            xtype: 'actioncolumn',
            cls: 'contactlist-icon-column-header contactlist-edit-column-header',
            width: 24,
            icon: 'resources/img/icons/pencil.png',
            tooltip: 'Edit',
            iconCls: 'x-hidden',
            sortable: false
        },
        {
            header: locale.contactlist.nameHeader, 
            dataIndex: 'name', 
            flex: 1
        },
        {
            header: locale.contactlist.lastNameHeader, 
            dataIndex: 'lastname', 
            flex: 1

        },
        {
            header: locale.contactlist.phoneHeader, 
            dataIndex: 'phone',  
            flex: 1
        },
        {
            header: locale.contactlist.emailHeader, 
            dataIndex: 'email',  
            flex: 1
        }
        ];
                       
        this.selModel = Ext.create('Ext.selection.CheckboxModel');
  
        this.callParent(arguments);
    },
    
    createToolbar: function(){
        var addButton = Ext.create('Ext.button.Button', {
            action: 'add',
            text    : locale.generic.add,
            icon: 'resources/img/icons/add.png'
        });

        var removeButton = Ext.create('Ext.button.Button', {
            action: 'delete',
            text    : locale.generic.remove,
            icon: 'resources/img/icons/delete.png'
        });

        var toolbar = Ext.create('Ext.toolbar.Toolbar', {
            items   : [addButton, removeButton]
        });
        
        return toolbar;
    }
});

