import React from 'react';
import {Container, Nav, Navbar, Image, NavDropdown} from 'react-bootstrap';
import { Link } from 'react-router-dom';
import styles from './Header.module.scss';

const Header = () => {
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
              <Nav.Link as={Link} to='/admin/profile'>
                <Image src="/profile/img2.jpg" roundedCircle className={styles.profileImg}></Image>
              </Nav.Link>
              <NavDropdown title='Admin A'>
                <NavDropdown.Item as={Link} to="/admin/login">
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