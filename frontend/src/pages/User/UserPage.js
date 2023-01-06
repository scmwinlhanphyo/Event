import React from 'react';
import { Container, Form, Button, Row, Col } from 'react-bootstrap';
import EventPagination from '../../components/EventPagination/EventPagination';
import { userData, userTableProperty, userDialogProperty } from '../../utils/constants/constant';
import EventDetailDialog from '../../components/EventDetailDialog/EventDetailDialog';
import ListTable from '../../components/ListTable/ListTable';
import styles from './UserPage.module.scss';

const UserPage = () => {
  const [showDialog, setShowDialog] = React.useState(false);
  const [userDialogData, setUserDialogData] = React.useState({});
  const [userList, setUserList] = React.useState(userData.data);
  const mounted = React.useRef(false);
  let nameInput = React.createRef();
  let emailInput = React.createRef();

  const handleDialog = (data) => {
    const flag = !showDialog;
    setShowDialog(flag);
    setUserDialogData(data);
  }

  const updateDeleteUser = (id, status) => {
    let preUserList = userList;
    const index = preUserList.findIndex(event => event.id === id);
    preUserList[index].status = status;
    preUserList[index].approvedBy = status === 'approved' ? 'WLP' : null;
    setUserList([...preUserList]);
  }

  const searchEvent = () => {
    console.log('input value', nameInput.current.value, emailInput.current.value);
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
        User List
      </div>
      <div className={styles.filterGroup}>
        <Form>
          <Row>
            <Col className={styles.filterCol}>
              <Form.Control className={styles.searchName} type="text" placeholder="Search By Name"
                ref={nameInput} />
            </Col>
            <Col className={styles.filterCol}>
              <Form.Control className={styles.searchName} type="text" placeholder="Search By Email"
                ref={emailInput} />
            </Col>
            <Col className={styles.filterCol}>
              <Button variant="primary" onClick={searchEvent}>Search</Button>
            </Col>
            <Col className={styles.filterCol}>
              <Button variant="primary">Create</Button>
            </Col>
          </Row>
        </Form>
      </div>
      <ListTable
        tableProperty={userTableProperty}
        list={userList}
        btnFunction={updateDeleteUser}
        handleDialog={handleDialog}
      />
      <EventPagination
        metadata={userData.metadata}
      />
      <EventDetailDialog
        show={showDialog}
        handleClose={handleDialog}
        data={userDialogData}
        dialogProperty={userDialogProperty} />
    </Container>
  )
}

export default UserPage;