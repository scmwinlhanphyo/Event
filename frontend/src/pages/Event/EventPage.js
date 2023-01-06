import React from 'react';
import { Container, Form, Button, Row, Col } from 'react-bootstrap';
import EventPagination from '../../components/EventPagination/EventPagination';
import { eventData, eventTableProperty, eventDialogProperty } from '../../utils/constants/constant';
import EventDetailDialog from '../../components/EventDetailDialog/EventDetailDialog';
import ListTable from '../../components/ListTable/ListTable';
import styles from './EventPage.module.scss';

const EventListPage = () => {
  const [showDialog, setShowDialog] = React.useState(false);
  const [eventDialogData, setEventDialogData] = React.useState({});
  const [eventList, setEventList] = React.useState(eventData.data);
  const mounted = React.useRef(false);
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
    if (!mounted.current) {
      console.log('mounted');
    }
    mounted.current = true;

    return () => {};
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
      <ListTable
        tableProperty={eventTableProperty}
        list={eventList}
        btnFunction={changeStatus}
        handleDialog={handleDialog}
      />
      <EventPagination
        metadata={eventData.metadata}
      />
      <EventDetailDialog
        show={showDialog}
        handleClose={handleDialog}
        data={eventDialogData}
        dialogProperty={eventDialogProperty} />
    </Container>
  )
}

export default EventListPage;