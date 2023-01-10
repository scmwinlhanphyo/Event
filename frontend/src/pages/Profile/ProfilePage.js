import React, { Fragment, useState } from "react";
import {Container, Row, Col, Image, Button, Breadcrumb, Form } from 'react-bootstrap';
import { useHistory } from 'react-router-dom';
import styles from "./ProfilePage.module.scss";
import { BsChevronDoubleRight } from "react-icons/bs";

const ProfilePage = () => {
    const history = useHistory();
    const handleUpdate = () => {
        history.push('/admin/user/1/update');
    }
    const [profileData, setProfileData] = useState({
        'name' : 'Admin A',
        'email': 'adminA@gmail.com',
        'address' : 'ygn',
        'dob' : '15-11-1998',
        'phone' : '09450000777',
        'profile' : '/profile/img6.jpg'
    });
    return(
        <div className={styles.wrapper}>
            <Breadcrumb className={styles.breadcrumb}>
                <Breadcrumb.Item href='/admin/users'>Users</Breadcrumb.Item>
                <Breadcrumb.Item href='/admin/profile' active className={styles.active}>Profile</Breadcrumb.Item>
            </Breadcrumb>
            <Container className={styles.container}>
                <Row>
                    <Col className="d-flex flex-column align-items-center" md={4}>
                        <Image src={profileData.profile} responsive className={styles.profileImg}></Image>
                        <h5 className="text-center"><label>{profileData.name}</label></h5>
                    </Col>
                    <Col>
                        <Row className="mb-3" xs={1} md={2}>
                            <Col>Email</Col>
                            <Col><strong>{profileData.email}</strong></Col>
                        </Row>
                        <Row className="mb-3" xs={1} md={2}>
                            <Col>Date Of Birth</Col>
                            <Col><strong>{profileData.dob}</strong></Col>
                        </Row>
                        <Row className="mb-3" xs={1} md={2}>
                            <Col>Address</Col>
                            <Col><strong>{profileData.address}</strong></Col>
                        </Row>
                        <Row className="mb-3" xs={1} md={2}>
                            <Col>Phone</Col>
                            <Col><strong>{profileData.phone}</strong></Col>
                        </Row>
                    </Col>
                </Row>
                <Row className="d-flex justify-content-center" md={4}>
                    <Button className={styles.updateBtn} onClick={handleUpdate}>
                        Update Profile
                        <BsChevronDoubleRight className={styles.nextIcon} />
                    </Button>
                </Row>
            </Container>
        </div>
    );
}

export default ProfilePage;