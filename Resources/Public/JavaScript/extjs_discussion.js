Ext.ns("Questionrating.Question");

Questionrating.Question.include = function() {
	return {
		init: function(plugin) {

			plugin.mytest = function() {
				alert("mytest function "+this.ajaxGetMessageUrl);
			};

			// setFilter
			plugin.setFilter = function() {
				var newFilter = Ext.get("route").dom.value;
				for(i = 0; i <= 7; i++) {
					if(Ext.get("filter_"+i).dom.checked)
						newFilter += "," + Ext.get("filter_"+i).dom.value;
				}
				this.params[this.extKey+"[filter]"] = newFilter;
				this.getMessage();
			};

			// resetFilter
			plugin.resetFilter = function() {
				Ext.get("route").dom.value = "both";
				for(i = 0; i <= 7; i++) {
					Ext.get("filter_"+i).dom.checked = false;
				}
				this.setFilter();
				if(this.allowDiscussion) {
					this.changeSendto(0);
				}
			};


			// getMessage
			plugin.getMessage = function() {
				this.messageBodyUpdater.update({
						url: this.ajaxGetMessageUrl,
						params: this.params
				});
			};

			// sendMessage
			plugin.sendMessage = function() {
				var sendParams = this.params;
				sendParams[this.extKey+"[toUser]"] = Ext.DomQuery.selectValue("input[name=sendto]:checked/@value");
				sendParams[this.extKey+"[message]"] = Ext.get("messageInput").dom.value;
				this.messageBodyUpdater.update({
						url: this.ajaxSendMessageUrl,
						params: sendParams
				});
				Ext.get("messageInput").dom.value = "";
			};

			// changeSendto
			plugin.changeSendto = function(newToId) {
				if(Ext.get("sendto_"+newToId) != null) {
					Ext.get("sendto_"+newToId).dom.checked = true;
				}
				else {
					Ext.get("sendto_0").dom.checked = true;
				}
				Ext.get("messageInput").focus();
			};

			// showDiscussion
			plugin.showDiscussion = function(route, userId) {
				Ext.get("route").dom.value = route;
				for(i = 0; i <= 7; i++) {
					if(userId != Ext.get("filter_"+i).dom.value) {
						Ext.get("filter_"+i).dom.checked = false;
					}
					else {
						Ext.get("filter_"+i).dom.checked = true
					}
				}
				this.setFilter();
				if(this.allowDiscussion) {
					if(this.currentUserId != userId) {
						this.changeSendto(userId);
					}
					else {
						this.changeSendto(0);
					}
				}
				return false;
			};

			// button
			Ext.get("set").on("click", function(){
				plugin.setFilter();
			}, plugin);

			Ext.get("showAll").on("click", function(){
				plugin.resetFilter();
			}, plugin);

			if(plugin.allowDiscussion) {
				Ext.get("send").on("click", function(){
					plugin.sendMessage();
				}, plugin);

				// keymap
				new Ext.KeyMap("messageInput", [
													{
														key: Ext.EventObject.ENTER,
														fn: function(){ plugin.sendMessage(); },
														scope: plugin
													}
												]);
			}
		}
	}
}();

