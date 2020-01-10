export default function(Vue){
	Vue.flashvalues = {

		flashValue(array_object){
			for (var i in array_object){

			}
		},


		thisIsBoolean(data){
			if(typeof data == 'boolean'){
				return true
			}
			return false
		}
	}

	Object.defineProperties(Vue.prototype, {
		$flashvalues : {
			get : () => {
				return Vue.flashvalues
			}
		}
	})
}