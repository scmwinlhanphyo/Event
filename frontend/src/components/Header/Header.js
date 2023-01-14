import React from 'react';
import {Container, Nav, Navbar, Image, NavDropdown} from 'react-bootstrap';
import { Link, useHistory } from 'react-router-dom';
import { imageURL } from '../../utils/constants/constant';
import styles from './Header.module.scss';
import axios from '../../axios/index';

const Header = () => {
  const history = useHistory();
  const storageData = JSON.parse(localStorage.getItem("user"));
  const currentUser = {
    'id' : storageData['id'],
    'name' : storageData['name'],
    'profile' : storageData['profile']
  };

  const handleLogout = () => {
    history.push('/admin/login');
    axios.post("/logout", storageData).then(response => {
      console.log(response);
    })
  }

  return (
    <>
      <Navbar className={styles.navBar+' shadow-sm'} variant="dark">
        <Container>
          <Navbar.Brand as={Link} to="/admin/events">Event</Navbar.Brand>
          <Navbar.Collapse>
            <Nav className="me-auto">
              <Nav.Link as={Link} to="/admin/events">Event</Nav.Link>
              <Nav.Link as={Link} to="/admin/users">User</Nav.Link>
            </Nav>
            <Nav className="justify-content-end align-items-center">
              <Nav.Link as={Link} to={`/admin/${currentUser.id}/profile`}>
                <Image src={imageURL + currentUser.profile} roundedCircle className={styles.profileImg}></Image>
              </Nav.Link>
              <NavDropdown title={currentUser.name}>
                <NavDropdown.Item as={Link} onClick={handleLogout}>
                  Log out
                </NavDropdown.Item>
              </NavDropdown>
            </Nav>
          </Navbar.Collapse>
          
        </Container>
      </Navbar>
    </>
  )
}

export default Header;