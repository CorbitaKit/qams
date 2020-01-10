export default function(Vue){


	Vue.requestservice = {


		getRequest(url){
			return axios.get(url).then(response=>{return response}).catch(err=>{return err})
		},

		postRequest(url,data){
			return axios.post(url,data).then(response=>{return response}).catch(err=>{return err})
		},

		deleteRequest(url){
			return axios.delete(url).then(response=>{return response}).catch(err=>{return err})
		},


	}

	Object.defineProperties(Vue.prototype,{
		$requestservice : {
			get : () => {
				return Vue.requestservice
			}
		}
	})
}