
    Ext.Loader.setConfig({enabled: true});
    Ext.Loader.setPath('components','app/components');
    Ext.QuickTips.init();
    
    Ext.require(['Ext.direct.*',]);
    Ext.onReady(function(){
        Ext.direct.Manager.addProvider(Ext.app.REMOTING_API);
    });

    Ext.application({
        name: 'ExtjsMVC',

        appFolder: 'app',

        controllers: [ 'ContactListController' ],
  
        launch: function() {
            
            Ext.create('Ext.container.Viewport', {                
                    layout : 'fit',
                    items  : [
                        { xtype: 'contactlist' }
                    ]
                
            });
        }
    });