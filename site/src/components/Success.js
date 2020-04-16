import React, { Component, useState } from 'react';
import 'date-fns';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import AppBar from 'material-ui/AppBar';



export class Success extends React.Component{    
    continue = e => {
        e.preventDefault();
        //FORM PHP A METTRE EN PLACE ICI
        this.props.nextStep();
    }

    back = e => {
        e.preventDefault();
        this.props.previousStep();
    }
    
    render() {

       
        const { values: { type , marque, modele, annee , km , entretien , ct  } } = this.props;
        return (
            <MuiThemeProvider>
                <React.Fragment>
                    <AppBar title="Succès"/>
                    <h1>Votre véhicule est bien enregistré.</h1>
                </React.Fragment>
            </MuiThemeProvider>
           
        )
    }
}

const stylesa = {
  button: {
    margin : 15
  }
}
export default Success
