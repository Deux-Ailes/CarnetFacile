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


export class FormPersonalDetails extends React.Component{    
    continue = e => {
        e.preventDefault();
        this.props.nextStep();
    }

    back = e => {
        e.preventDefault();
        this.props.previousStep();
    }
    
    render() {

       
        const { values, handleChange } = this.props;
        return (
            <MuiThemeProvider>
                <React.Fragment>
                    <AppBar title="Informations détaillées"/>
                    <br/>
                    <TextField
                        hintText="Distance parcourue (en km)"
                        floatingLabelText="Kilométrage"
                        onChange={handleChange('km')}
                        defaultValue={values.km}
                    />
                    <br/>
                    <h6><u>Date du dernier entretien</u></h6>
                    <TextField
                        id="date"
                        label="Date du dernier entretien"
                        type="date"
                        onChange={handleChange('entretien')}
                        defaultValue={values.entretien}
                        InputLabelProps={{
                            shrink: true,
                        }}
                        variant="outlined"
                    />
                    <br/>
                   
                    <br/>
                    <h6><u>Date du dernier contrôle technique</u></h6>
                    <TextField
                        id="date"
                        label="Date du véhicule"
                        type="date"
                        onChange={handleChange('ct')}
                        defaultValue={values.ct}
                        InputLabelProps={{
                            shrink: true,
                        }}
                        variant="outlined"
                    />
                    <br/>
                    <RaisedButton 
                        label="Retour"
                        primary={false}
                        style={stylesa.button}
                        onClick={this.back}
                    />
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
export default FormPersonalDetails
