import {Notification,MessageBox} from 'element-ui'

export default function(Vue,RequestService){

	Vue.alertmessageservice = {



		successMessage(success_message){

			Notification.success({
				title : "success",
				message : success_message,
				position : "bottom-right"
			})
		},

		failMessage(error_message){
			Notification.error({
				title : "error",
				message : error_message,
				position : "bottom-right"
				
			})
		},

		confirmationMessage(){
			return MessageBox.confirm('This will permanently delete the data. Continue?', 'Warning', {
			        	confirmButtonText: 'Delete',
			          	cancelButtonText: 'Cancel',
			          	type: 'warning'
			        })
					.then(()=>{return true})
					.catch(()=>{return false})
		},

		warningMessage(warning_message){
			Notification.warning({
				title : "warning",
				message : warning_message,
				position : "bottom-right"
				
			})
		}
	}

	Object.defineProperties(Vue.prototype, {
		$alertmessageservice : {
			get : () => {
				return Vue.alertmessageservice
			}
		}
	})
}