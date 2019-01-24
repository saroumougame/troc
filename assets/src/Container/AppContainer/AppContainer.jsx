import React from 'react';
import ReactDOM from 'react-dom';
import './AppContainer.scss';

class AppContainer extends React.Component {

    render(){
        return (
            <div className="app-container">
                <h1>AppContainer is ready !</h1>
            </div>
        )
    }
}


ReactDOM.render(
<AppContainer/>,
    document.querySelector('#app-container')
);
