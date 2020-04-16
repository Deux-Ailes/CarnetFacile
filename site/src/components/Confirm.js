import React, { Component, useState } from 'react';
import 'date-fns';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import AppBar from 'material-ui/AppBar';
import { makeStyles } from '@material-ui/core/styles';
import {List, ListItem} from 'material-ui/List';
import MenuItem from '@material-ui/core/MenuItem';
import RaisedButton from 'material-ui/RaisedButton';
import DateFnsUtils from '@date-io/date-fns'; // choose your lib
import {
  DatePicker,
  TimePicker,
  DateTimePicker,
  MuiPickersUtilsProvider,
} from '@material-ui/pickers';
import { styles } from '@material-ui/pickers/views/Calendar/Calendar';


export class Confirm extends React.Component{    
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
                    <AppBar title="Confirmation des informations"/>
                    <br/>
                    <List>
                        <ListItem 
                            primaryText="Type"
                            secondaryText={type}
                        />
                        <ListItem 
                            primaryText="Marque"
                            secondaryText={marque}
                        />
                        <ListItem 
                            primaryText="Modèle"
                            secondaryText={modele}
                        />
                        <ListItem 
                            primaryText="Année"
                            secondaryText={annee}
                        />
                        <ListItem 
                            primaryText="Distance (en km)"
                            secondaryText={km}
                        />
                        <ListItem 
                            primaryText="Dernier entretien"
                            secondaryText={entretien}
                        />
                        <ListItem 
                            primaryText="Dernier CT"
                            secondaryText={ct}
                        />

                    </List>                    
                    <RaisedButton 
                        label="Retour"
                        primary={false}
                        style={stylesa.button}
                        onClick={this.back}
                    />
                    <RaisedButton 
                      label="Confirmation"
                      primary={true}
                      style={stylesa.button}
                      onClick={this.continue}
                    /> 
                    
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
export default Confirm
