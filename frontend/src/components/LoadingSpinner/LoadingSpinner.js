import React, { Fragment } from 'react';
import {Spinner} from 'react-bootstrap';
import styles from './LoadingSpinner.module.scss';

const LoadingSpinner = () => {
    return(
        <div className={styles.loadingContainer}>
        <span>Loading ... </span>
            <Spinner variant="dark" animation="grow" size="sm" />
            <Spinner variant="dark" animation="grow" />
        </div>
    );
}

export default LoadingSpinner;
