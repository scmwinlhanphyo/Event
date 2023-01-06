import React from "react";
import { Switch, Redirect, withRouter } from "react-router-dom";
import PublicRoute from "./PublicRoute";
import PrivateRoute from "./PrivateRoute";
import LoginPage from "../pages/Login/LoginPage";
import HomePage from "../pages/Home/HomePage";
import EventListPage from "../pages/EventList/EventListPage";
import Header from "../components/Header/Header";
import Footer from "../components/Footer/Footer";
import CreatePage from "../pages/Create/CreatePage";

const AppRouter = withRouter(({ location }) => {

  console.log('pathname', location.pathname);

  /**
   * make path for each component.
   */
  return (
    <>
      {
        (location.pathname !== '/admin/login' && location.pathname !== '/user/create') && <Header showMenu={true} />
      }
      <Switch>
        <PublicRoute path="/admin/login" component={LoginPage} />
        <PrivateRoute path="/admin/home" component={HomePage} />
        <PrivateRoute path="/admin/events" component={EventListPage} />
        <PublicRoute path="/admin/user/create" component={CreatePage} />
        <PrivateRoute path="/admin/user/1/update" component={CreatePage} />

        {/* Redirect all 404's to home */}
        <Redirect to='/admin/login' />
      </Switch>
      {
        (location.pathname !== '/admin/login' && location.pathname !== '/user/create') && <Footer />
      }
    </>
  )
})

export default AppRouter;
