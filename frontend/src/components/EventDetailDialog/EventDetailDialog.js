import React from 'react';
import {Modal, Button, Container, Row, Col} from 'react-bootstrap';
import moment from 'moment';
import styles from './EventDetailDialog.module.css';

const EventDetailDialog = ({show, handleClose, data}) => {

  return (
    <Modal show={show} onHide={handleClose}>
      <Modal.Header closeButton>
        <Modal.Title>Event Detail</Modal.Title>
      </Modal.Header>
      <Modal.Body>
        <Container>
          <Row className={styles.eventImgRow}>
            <img className={styles.eventImg} src={data?.img} />
          </Row>
          <Row className={styles.eventRow}>
            <Col>Event Name</Col>
            <Col>{data?.eventName}</Col>
          </Row>
          <Row className={styles.eventRow}>
            <Col>Description</Col>
            <Col>{data?.description}</Col>
          </Row>
          <Row className={styles.eventRow}>
            <Col>Status</Col>
            <Col>{data?.status}</Col>
          </Row>
          <Row className={styles.eventRow}>
            <Col>From Date</Col>
            <Col>{moment(data?.fromDate).format('DD MMM YYYY')}</Col>
          </Row>
          <Row className={styles.eventRow}>
            <Col>To Date</Col>
            <Col>{moment(data?.toDate).format('DD MMM YYYY')}</Col>
          </Row>
          <Row className={styles.eventRow}>
            <Col>From Time</Col>
            <Col>{data?.fromTime}</Col>
          </Row>
          <Row className={styles.eventRow}>
            <Col>To Time</Col>
            <Col>{data?.toTime}</Col>
          </Row>
          <Row className={styles.eventRow}>
            <Col>Address</Col>
            <Col>{data?.address}</Col>
          </Row>
          <Row className={styles.eventRow}>
            <Col>Approved by</Col>
            <Col>{data?.approvedBy}</Col>
          </Row>
          <Row className={styles.eventRow}>
            <Col>Created At</Col>
            <Col>{moment(data?.createdAt).format('DD MMM YYYY')}</Col>
          </Row>
          <Row className={styles.eventRow}>
            <Col>Update At</Col>
            <Col>{moment(data?.updatedAt).format('DD MMM YYYY')}</Col>
          </Row>
        </Container>
      </Modal.Body>
      <Modal.Footer>
        <Button variant="secondary" onClick={handleClose}>
          Close
        </Button>
      </Modal.Footer>
    </Modal>);
};

export default EventDetailDialog;