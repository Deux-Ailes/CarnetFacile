import React, { Component, useState } from 'react';
import 'date-fns';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import AppBar from 'material-ui/AppBar';
import { makeStyles } from '@material-ui/core/styles';
import TextField from 'material-ui/TextField';
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





export class FormUserDetails extends React.Component{    
    continue = e => {
        e.preventDefault();
        this.props.nextStep();
    }
    
    render() {

       
        const { values, handleChange } = this.props;
        return (
            <MuiThemeProvider>
                <React.Fragment>
                    <AppBar title="Informations générales"/>
                    <br/>
                    <TextField
                        hintText="Moto / Voiture / Bateau / Autre"
                        floatingLabelText="Type du véhicule"
                        onChange={handleChange('type')}
                        defaultValue={values.type}
                    />
                    <br/>
                    <TextField
                        hintText="Marque"
                        floatingLabelText="Marque du véhicule"
                        onChange={handleChange('marque')}
                        defaultValue={values.marque}
                    />
                    <br/>
                    <TextField
                        hintText="Modèle"
                        floatingLabelText="Modèle du véhicule"
                        onChange={handleChange('modele')}
                        defaultValue={values.modele}
                    />
                    <br/>
                    <h6><u>Date de première mise en circulation</u></h6>
                    <TextField
                        id="date"
                        label="Date du véhicule"
                        type="date"
                        onChange={handleChange('annee')}
                        defaultValue={values.annee}
                        InputLabelProps={{
                          shrink: true,
                        }}
                        variant="outlined"
                    />
                    <br/>
                    <RaisedButton 
                      label="Suivant"
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
export default FormUserDetails
