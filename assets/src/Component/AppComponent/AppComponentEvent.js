class AppComponentEvent{

    handleClick(e) {

        this.setState((prevState)=>{
            return {
                isToggleOn: !prevState.isToggleOn
            }
        });
    }


}

export default (new AppComponentEvent());