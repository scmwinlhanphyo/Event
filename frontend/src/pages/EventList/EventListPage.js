import React from 'react';
import { Table, Container, Form, Button, Row, Col } from 'react-bootstrap';
import moment from 'moment';
import EventPagination from '../../components/EventPagination/EventPagination';
import { eventData } from '../../utils/constants/constant';
import EventDetailDialog from '../../components/EventDetailDialog/EventDetailDialog';
import styles from './EventListPage.module.css';

const EventListPage = () => {
  const [showDialog, setShowDialog] = React.useState(false);
  const [eventDialogData, setEventDialogData] = React.useState({});
  const [eventList, setEventList] = React.useState(eventData.data);
  let nameInput = React.createRef();
  let fromDateInput = React.createRef();
  let toDateInput = React.createRef();

  const handleDialog = (data) => {
    const flag = !showDialog;
    setShowDialog(flag);
    setEventDialogData(data);
  }

  const changeStatus = (id, status) => {
    let preEventList = eventList;
    const index = preEventList.findIndex(event => event.id === id);
    preEventList[index].status =  status;
    preEventList[index].approvedBy = status === 'approved' ? 'WLP' : null;
    setEventList([...preEventList]);
  }

  const searchEvent = () => {
    console.log('input value', nameInput.current.value, fromDateInput.current.value, toDateInput.current.value);
  }

  React.useEffect(() => {
    console.log('mounted');
  }, []);

  return (
    <Container className={styles.container}>
      <div className={styles.title}>
        Event List
      </div>
      <div className={styles.filterGroup}>
        <Form>
          <Row>
            <Col className={styles.filterCol}>
              <Form.Control className={styles.searchName} type="text" placeholder="Search By Name"
              ref={nameInput} />
            </Col>
            <Col className={styles.filterCol}>
              <div className={styles.fromDate}>
                <label>From Date</label>
                <Form.Control type="date" className={styles.fromDateInput} name="fromDate" placeholder="From Date" ref={fromDateInput} />
              </div>
            </Col>
            <Col className={styles.filterCol}>
              <div className={styles.toDate}>
                <label>To Date</label>
                <Form.Control type="date" className={styles.toDateInput} name="toDate" placeholder="To Date" ref={toDateInput} />
              </div>
            </Col>
            <Col className={styles.filterCol}>
              <Button variant="primary" onClick={searchEvent}>Search</Button>
            </Col>
          </Row>
        </Form>
      </div>
      <Table striped bordered hover className={styles.eventTable}>
        <thead>
          <tr>
            <th>No</th>
            <th>Image</th>
            <th>Event Name</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>Status</th>
            <th>Approved by</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          {
            eventList.map((event, index) => (
              <tr key={event.id}>
                <td>{index + 1}</td>
                <td>
                  {(event?.img) && <img alt='eventImage' className={styles.eventImg} src={event.img} />}
                </td>
                <td>
                  <a className={styles.eventName} onClick={() => handleDialog(event)}>{event.eventName}</a>
                </td>
                <td>{moment(event.fromDate).format('DD/MM/YYYY')}</td>
                <td>{moment(event.toDate).format('DD/MM/YYYY')}</td>
                <td>{event.status}</td>
                <td>{event.approvedBy}</td>
                <td>{moment(event.createdAt).format('DD MMM YYYY')}</td>
                <td>{moment(event.updatedAt).format('DD MMM YYYY')}</td>
                <td>
                  {(event.status === 'new' || event.status === 'approved') &&
                  <Button variant="danger" className={styles.rejectBtn} onClick={() =>
                    changeStatus(event.id, 'rejected')}>Reject</Button>
                  }
                  {(event.status === 'new' || event.status === 'rejected') &&
                  <Button variant="primary" onClick={() =>
                    changeStatus(event.id, 'approved')}>Approve</Button>
                  }
                </td>
              </tr>
            ))
          }
        </tbody>
      </Table>
      <EventPagination
        metadata={eventData.metadata}
      />
      <EventDetailDialog show={showDialog} handleClose={handleDialog} data={eventDialogData}/>
    </Container>
  )
}

export default EventListPage;