import React from 'react';
import {Modal, Button, Container, Row, Col} from 'react-bootstrap';
import moment from 'moment';
import styles from './EventDetailDialog.module.scss';

const EventDetailDialog = ({show, handleClose, data, dialogProperty}) => {

  return (
    <Modal show={show} onHide={handleClose}>
      <Modal.Header closeButton>
        <Modal.Title>{dialogProperty.title}</Modal.Title>
      </Modal.Header>
      <Modal.Body>
        <Container>
          <Row className={styles.eventImgRow}>
            {data?.img ? <img className={styles.eventImg} src={data?.img} />
            :
            <img className={styles.eventImg} src={data?.profile} />}
          </Row>
          {dialogProperty.property.map((dist, index) => (
            <Row className={styles.eventRow} key={index}>
              <Col>{dist.label}</Col>
              {(dist.type === 'date') ? 
              <Col>
              {(dist.key === 'fromDate') ? moment(data?.[dist.key]).format('DD/MM/YYYY') + '~' + moment(data?.toDate).format('DD/MM/YYYY') : data?.[dist.key] ? moment(data?.[dist?.key]).format('DD MMM YYYY') : ''}
              </Col>
              :
              (dist.type === 'time') ? <Col>{data?.fromTime + '~' + data?.toTime}</Col>
              :
              <Col>{data?.[dist.key]}</Col>
              }
            </Row>
          ))}
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